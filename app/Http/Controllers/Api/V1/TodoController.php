<?php

namespace App\Http\Controllers\Api\V1;


use App\Http\Requests\Api\V1\Todo\CommentAddRequest;
use App\Http\Requests\Api\V1\Todo\TodoAddRequest;
use App\Http\Requests\Api\V1\Todo\TodoAdminUpdateRequest;
use App\Http\Requests\Api\V1\Todo\TodoSearchAllRequest;
use App\Http\Requests\Api\V1\Todo\TodoSearchSelfRequest;
use App\Http\Requests\Api\V1\Todo\TodoUpdateRequest;
use App\Http\Resources\Todo\CommentResource;
use App\Http\Resources\Todo\DetailTodoResource;
use App\Http\Resources\Todo\TodoListAllResource;
use App\Http\Resources\Todo\TodoListSelfResource;
use App\Models\Todo;
use App\Models\TodoComments;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class TodoController extends BaseApiController
{

    public array $additional =
        ['status' => 'success', 'message' => 'لیست وظایف ارسال شد'];

    public function todoSearchAll(TodoSearchAllRequest $request)
    {
        if (Gate::allows('isAdmin', auth()->user())) {
            $todo = Todo::query();
            $input = $request['inputSearch'];

            switch ($request['scopeSearch']) {


                case 'user_email':
                    $users = User::query()->where('email', 'like', "%$input%")->pluck('id');
                    $todo = $todo->whereIn('user_id', $users)->paginate(5);
                    break;

                case 'user_name':
                    $users = User::query()->where('name', 'like', "%$input%")->pluck('id');
                    $todo = $todo->whereIn('user_id', $users)->paginate(5);
                    break;
                case 'todo_title':
                    $todo = $todo->where('title', 'like', "%$input%")->paginate(5);
                    break;
                case 'todo_content':
                    $todo = $todo->where('content', 'like', "%$input%")->paginate(5);
                    break;
                case 'todo_finally_result':
                    $todo = $todo->where('finally_result', 'like', "%$input%")->paginate(5);
                    break;
                case 'todo_finally_status':
                    $todo = $todo->where('finally_status', 'like', "%$input%")->paginate(5);
                    break;
                default:
                    return BaseApiController::FailResponse(400, 'خطا در جستوجو');
            }
            return TodoListAllResource::collection($todo)->additional($this->additional);
        } else {
            $message = 'شما مجوز لازم را ندارید';
            return BaseApiController::FailResponse(403, $message);
        }
    }


    public function todoSearchSelf(TodoSearchSelfRequest $request)
    {
        $todo = Todo::query()->where('user_id', auth()->user()->id);
        $input = $request['inputSearch'];

        switch ($request['scopeSearch']) {
            case 'todo_title':
                $todo = $todo->where('title', 'like', "%$input%")->paginate(5);
                break;
            case 'todo_content':
                $todo = $todo->where('content', 'like', "%$input%")->paginate(5);
                break;
            case 'todo_finally_result':
                $todo = $todo->where('finally_result', 'like', "%$input%")->paginate(5);
                break;
            case 'todo_finally_status':
                $todo = $todo->where('finally_status', 'like', "%$input%")->paginate(5);
                break;
            default:
                return BaseApiController::FailResponse(400, 'خطا در جستوجو');
        }
        return TodoListSelfResource::collection($todo)->additional($this->additional);

    }


    public function todoAdd(TodoAddRequest $request)
    {
        $request['user_id'] = empty($request['user_id']) ?? auth()->user()->id;
        $cleanData = [
            'title' => $request['todo-title'],
            'content' => $request['todo-body'],
            'deadline' => $request ['todo-deadline'],
            'result' => $request['resultSelf'],
            'user_id' => auth()->user()->admin ? $request['user_id'] : auth()->user()->id
        ];
        Todo::query()->create($cleanData);
        return BaseApiController::successResponse(201, 'مسئولیت جدید اضافه شد');
    }

    public function todoUpdateAdmin(TodoAdminUpdateRequest $request)
    {
        if (Gate::allows('isAdmin', auth()->user())) {
            $todo = Todo::query()->findOrFail($request['todo_id']);
            $cleanData = [
                'title' => $request['todo-title'],
                'content' => $request['todo-body'],
                'deadline' => $request ['todo-deadline'],
                'result' => $request['resultSelf'],
                'finally_result' => $request['finally-result'],
                'finally_status' => $request['status-finally'],
            ];
            $todo->update($cleanData);
            return BaseApiController::successResponse(200, 'مسئولیت انتخابی بروزرسانی شد');
        } else {
            return BaseApiController::FailResponse(403, 'شما مجوز لازم را ندارید');
        }
    }

    public function todoUpdate(TodoUpdateRequest $request)
    {
        $todo = Todo::query()->findOrFail($request['todo_id']);
        $todo->update(['result' => $request['resultSelf']]);
        return BaseApiController::successResponse(200, 'مسئولیت انتخابی بروزرسانی شد');

    }

    public function todoListSelf()
    {
        $todo = Todo::query()->where('user_id', auth()->user()->id)->paginate(5);
        return TodoListSelfResource::collection($todo)->additional($this->additional);

    }

    public function todoListAll()
    {
        if (Gate::allows('isAdmin', auth()->user())) {
            $todo = Todo::query()->paginate(5);
            return TodoListAllResource::collection($todo)->additional($this->additional);
        } else {
            $message = 'شما مجوز لازم را ندارید';
            return BaseApiController::FailResponse(403, $message);
        }
    }


    public function detail(int $id)
    {
        $todo = Todo::query()->where('user_id', auth()->user()->id)->findOrFail($id);
        return new DetailTodoResource($todo);

    }

    public function commentsTodo(int $todo_id)
    {
        if (Gate::allows('adminOrOwner', Todo::query()->findOrFail($todo_id))) {
            $comments = TodoComments::query()->where('todo_id', $todo_id)->paginate(5);
            return CommentResource::collection($comments);
        } else {
            return self::FailResponse(403, 'شما مجوز لازم را ندارید');
        }
    }


    public function commentRemove(int $todo_id)
    {
        // just admin can delete comments
        if (Gate::allows('isAdmin', auth()->user())) {
            TodoComments::query()->findOrFail($todo_id)->delete();
            return BaseApiController::successResponse(200, 'نظر حذف شد');
        } else {
            return self::FailResponse(403, 'شما مجوز لازم را ندارید');
        }
    }

    public function commentAdd(CommentAddRequest $request)
    {
        $todo = Todo::query()->findOrFail($request['todo_id']);
        if (Gate::allows('adminOrOwner', $todo)) {
            TodoComments::query()->create([
                'user_id' => auth()->user()->id,
                'todo_id' => $request['todo_id'],
                'content' => $request['content_comment'],
            ]);
            return BaseApiController::successResponse(201, 'نظر جدید ثبت شد');
        } else {
            return self::FailResponse(403, 'شما مجوز لازم را ندارید');
        }
    }
}
