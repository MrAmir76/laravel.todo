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
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Gate;
use OpenApi\Annotations as OA;
use PHPUnit\TextUI\XmlConfiguration\FailedSchemaDetectionResult;

class TodoController extends BaseApiController
{

    public array $additional =
        ['status' => 'success', 'message' => 'لیست وظایف ارسال شد'];


    /**
     * @OA\Post(
     *     path="/api/v1/todo/search/all",
     *     summary="search in all todos [Login Required]",
     *     operationId="AllSearchTodo",
     *     tags={"Search"},
     *     security={{"sanctum": {}}},
     *
     *     @OA\RequestBody(required=true, description="Search Todo",
     *         @OA\JsonContent(
     *             @OA\Property(property="inputSearch", type="string", example="Recusandae"),
     *             @OA\Property(property="scopeSearch", type="string",enum={"user_email","user_name","todo_title","todo_content","todo_finally_result","todo_finally_status"}, example="todo_title"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Todoes send successfully",
     *         @OA\JsonContent(
     *              @OA\Property(property="status", type="string", example="true"),
     *              @OA\Property(property="message", type="string", example="نتایج ارسال شد"),
     *              @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/TodoAllResource")),
     *              @OA\Property(property="links", type="array", @OA\Items(ref="#/components/schemas/Links")),
     *              @OA\Property(property="meta", type="array", @OA\Items(ref="#/components/schemas/Meta")),
     *          ),
     *      ),
     *    @OA\Response(response=401,description="Unauthenticated",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated")
     *         )
     *     ),
     *     @OA\Response(response=422,description="Validation Error",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="fail"),
     *             @OA\Property(property="message", type="string", example="اطلاعات وارد شده نامعتبر است"),
     *             @OA\Property(property="errors", type="object",
     *                 @OA\Property(property="scopeSearch", type="array", @OA\Items(type="string", example="متن خطای مربوط به این فیلد")),
     *                 @OA\Property(property="inputSearch", type="array", @OA\Items(type="string", example="متن خطای مربوط به این فیلد"))
     *             )
     *         )
     *     )
     * )
     */
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

    /**
     * @OA\Post(
     *     path="/api/v1/todo/search/self",
     *     summary="search in self todos [Login Required]",
     *     operationId="SelfSearchTodo",
     *     tags={"Search"},
     *     security={{"sanctum": {}}},
     *
     *     @OA\RequestBody(required=true, description="Search Todo",
     *         @OA\JsonContent(
     *             @OA\Property(property="inputSearch", type="string", example="Recusandae"),
     *              @OA\Property(property="scopeSearch", type="string",enum={"user_email","user_name","todo_title","todo_content","todo_finally_result","todo_finally_status"}, example="todo_title"),
     *              )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Todoes send successfully",
     *         @OA\JsonContent(
     *              @OA\Property(property="status", type="string", example="true"),
     *              @OA\Property(property="message", type="string", example="نتایج ارسال شد"),
     *              @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/TodoSelfResource")),
     *              @OA\Property(property="links", type="array", @OA\Items(ref="#/components/schemas/Links")),
     *              @OA\Property(property="meta", type="array", @OA\Items(ref="#/components/schemas/Meta")),
     *          ),
     *      ),
     *    @OA\Response(response=401,description="Unauthenticated",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated")
     *         )
     *     ),
     *     @OA\Response(response=422,description="Validation Error",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="fail"),
     *             @OA\Property(property="message", type="string", example="اطلاعات وارد شده نامعتبر است"),
     *             @OA\Property(property="errors", type="object",
     *                 @OA\Property(property="scopeSearch", type="array", @OA\Items(type="string", example="متن خطای مربوط به این فیلد")),
     *                 @OA\Property(property="inputSearch", type="array", @OA\Items(type="string", example="متن خطای مربوط به این فیلد"))
     *             )
     *         )
     *     )
     * )
     */
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

    /**
     * @OA\Post(
     *     path="/api/v1/todo/add",
     *     summary="Add a new Todo [Login Required]",
     *     operationId="addTodo",
     *     tags={"Todo"},
     *     security={{"sanctum": {}}},
     *     @OA\RequestBody( required=true, description="Todo details",
     *         @OA\JsonContent(
     *             @OA\Property(property="todo-title", type="string", minLength=2,example="Todo Title"),
     *             @OA\Property(property="todo-body", type="string", minLength=5, example="Todo Body"),
     *             @OA\Property(property="todo-deadline", type="integer", minimum=1, maximum=365, example=7),
     *             @OA\Property(property="resultSelf", type="string", minLength=2, nullable=true, example="Result Self"),
     *             @OA\Property(property="user_id", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Todo added successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="مسئولیت جدید اضافه شد")
     *         )
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Unauthenticated"),
     *          )
     *      ),
     *     @OA\Response(
     *           response=422,
     *           description="Validation Error",
     *           @OA\JsonContent(
     *               @OA\Property(property="status", type="string", example="fail"),
     *               @OA\Property(property="message", type="string", example="اطلاعات وارد شده نامعتبر است"),
     *               @OA\Property(property="errors", type="object",
     *                   @OA\Property(property="todo-title", type="array",
     *                       @OA\Items(type="string", example="متن خطای مربوط به این فیلد")
     *                   ),
     *                   @OA\Property(property="todo-body", type="array",
     *                       @OA\Items(type="string", example="متن خطای مربوط به این فیلد")
     *                   ),
     *                   @OA\Property(property="todo-deadline", type="array",
     *                       @OA\Items(type="string", example="متن خطای مربوط به این فیلد")
     *                   ),
     *                   @OA\Property(property="resultSelf", type="array",
     *                       @OA\Items(type="string",example="متن خطای مربوط به این فیلد")
     *                   ),
     *                  @OA\Property(property="user_id", type="array",
     *                        @OA\Items(type="string",example="متن خطای مربوط به این فیلد")
     *                    )
     *               )
     *           )
     *       ),
     * )
     */
    public function todoAdd(TodoAddRequest $request)
    {
        if (!auth()->user()->admin) $request['user_id'] = auth()->user()->id;
        $cleanData = [
            'title' => $request['todo-title'],
            'content' => $request['todo-body'],
            'deadline' => $request ['todo-deadline'],
            'result' => $request['resultSelf'],
            'user_id' => $request['user_id']
        ];
        Todo::query()->create($cleanData);
        return BaseApiController::successResponse(201, 'مسئولیت جدید اضافه شد');
    }

    /**
     * @OA\Post(
     *     path="/api/v1/todo/update",
     *     summary="Updated todo by normal user [Login Required]",
     *     operationId="updateTodo",
     *     tags={"Todo"},
     *     security={{"sanctum": {}}},
     *     @OA\RequestBody(required=true, description="Todo update",
     *         @OA\JsonContent(
     *             @OA\Property(property="todo_id", type="integer", minLength=1,example="20"),
     *             @OA\Property(property="resultSelf", type="string", minLength=2, example="This is a selfResult"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Todo updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="مسئولیت بروزرسانی شد")
     *         )
     *     ),
     *     @OA\Response(
     *          response=404,
     *          description="NotFound",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="string", example="fail"),
     *              @OA\Property(property="message", type="string", example="چنین مسئولیتی برای بروزرسانی وجود ندارد یا مسولیت بسته شده است")
     *          )
     *      ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Unauthenticated"),
     *          )
     *      ),
     *     @OA\Response(
     *           response=422,
     *           description="Validation Error",
     *           @OA\JsonContent(
     *               @OA\Property(property="status", type="string", example="fail"),
     *               @OA\Property(property="message", type="string", example="اطلاعات وارد شده نامعتبر است"),
     *               @OA\Property(property="errors", type="object",
     *                   @OA\Property(property="todo-id", type="array",
     *                       @OA\Items(type="string", example="متن خطای مربوط به این فیلد")
     *                   ),
     *                   @OA\Property(property="resultSelf", type="array",
     *                       @OA\Items(type="string",example="متن خطای مربوط به این فیلد")
     *                   ),
     *               )
     *           )
     *       ),
     * )
     */
    public function todoUpdate(TodoUpdateRequest $request)
    {
        try {
            $todo = Todo::query()->where('finally_status', null)->findOrFail($request['todo_id']);
            $todo->update(['result' => $request['resultSelf']]);
            return BaseApiController::successResponse(200, 'مسئولیت انتخابی بروزرسانی شد');
        } catch (ModelNotFoundException) {
            return BaseApiController::FailResponse(404,
                'چنین مسئولیتی برای بروزرسانی وجود ندارد یا مسولیت بسته شده است');

        }
    }

    /**
     * @OA\Post(
     *     path="/api/v1/todo/updateAdmin",
     *     summary="Updated todo by admin user [Login Required]",
     *     operationId="adminUpdateTodo",
     *     tags={"Todo"},
     *     security={{"sanctum": {}}},
     *     @OA\RequestBody(required=true, description="Todo update",
     *         @OA\JsonContent(
     *             @OA\Property(property="todo_id", type="integer", minimum=1,example="20"),
     *             @OA\Property(property="todo-title", type="string", minLength=2,example="Test title"),
     *             @OA\Property(property="todo-body", type="string", minLength=5,example="Test Body"),
     *             @OA\Property(property="todo-deadline", type="integer", minimum=1,example="6"),
     *             @OA\Property(property="resultSelf", type="string", minLength=2, example="This is a selfResult"),
     *             @OA\Property(property="finally-result", type="string", minLength=5, example="This is a finallyResult"),
     *             @OA\Property(property="status-finally", type="integer", nullable=true),
     *
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Todo updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="مسئولیت بروزرسانی شد")
     *         )
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Unauthenticated"),
     *          )
     *      ),
     *     @OA\Response(
     *           response=422,
     *           description="Validation Error",
     *           @OA\JsonContent(
     *               @OA\Property(property="status", type="string", example="fail"),
     *               @OA\Property(property="message", type="string", example="اطلاعات وارد شده نامعتبر است"),
     *               @OA\Property(property="errors", type="object",
     *                   @OA\Property(property="todo-id", type="array",
     *                       @OA\Items(type="string", example="متن خطای مربوط به این فیلد")
     *                   ),
     *                   @OA\Property(property="resultSelf", type="array",
     *                       @OA\Items(type="string",example="متن خطای مربوط به این فیلد")
     *                   ),
     *               )
     *           )
     *       ),
     * )
     */
    public function todoUpdateAdmin(TodoAdminUpdateRequest $request)
    {
        try {
            if (Gate::allows('isAdmin', auth()->user())) {
                $todo = Todo::query()->where('finally_status', null)->findOrFail($request['todo_id']);
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
        } catch (ModelNotFoundException) {
            return BaseApiController::FailResponse(404,
                'چنین مسئولیتی برای بروزرسانی وجود ندارد یا مسولیت بسته شده است');
        }
    }

    /**
     * @OA\Get(
     *     path="/api/v1/todo/list/self",
     *     summary="Get List of Self Todo  [Login Required]",
     *     operationId="selfTodoList",
     *     tags={"Todo"},
     *     security={{"sanctum": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Send TodoList successfully",
     *         @OA\JsonContent(
     *            @OA\Property(property="status", type="string", example="success"),
     *            @OA\Property(property="message", type="string", example="لیست وظایف ارسال شد"),
     *            @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/TodoSelfResource")),
     *            @OA\Property(property="links", type="array", @OA\Items(ref="#/components/schemas/Links")),
     *            @OA\Property(property="meta", type="array", @OA\Items(ref="#/components/schemas/Meta")),
     *         )
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Unauthenticated"),
     *          )
     *      ),
     * )
     */
    public function todoListSelf()
    {
        $todo = Todo::query()->where('user_id', auth()->user()->id)->paginate(5);
        return TodoListSelfResource::collection($todo)->additional($this->additional);

    }


    /**
     * @OA\Get(
     *     path="/api/v1/todo/list/all",
     *     summary="Get List of all Todo  [Login Required]",
     *     operationId="allTodoLis",
     *     tags={"Todo"},
     *     security={{"sanctum": {}}},
     *     @OA\Response(response=200, description="Todoes send successfully",
     *         @OA\JsonContent(
     *              @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/TodoAllResource")),
     *              @OA\Property(property="status", type="string", example="success"),
     *              @OA\Property(property="message", type="string", example="لیست وظایف ارسال شد"),
     *              @OA\Property(property="links", type="array", @OA\Items(ref="#/components/schemas/Links")),
     *              @OA\Property(property="meta", type="array", @OA\Items(ref="#/components/schemas/Meta")),
     *          ),
     *      ),
     *    @OA\Response(response=401,description="Unauthenticated",
     *         @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Unauthenticated")
     *         )
     *     ),
     * )
     */
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


    /**
     * @OA\Get(
     *     path="/api/v1/todo/detail/{id}",
     *     summary="Get Detail of a Todo [Login Required]",
     *     operationId="DetailTodo",
     *     tags={"Todo"},
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(name="id",in="path",required=true,
     *                  description="The ID of the Todo",
     *                  @OA\Schema(type="integer",format="int64",minimum=1,example=1)
     *     ),
     *     @OA\Response(response=200,description="Todo sent successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/DetailTodoResource")),
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="جزئیات وظیفه ارسال شد")
     *         )
     *     ),
     *     @OA\Response(response=404,description="NotFound",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="string", example="fail"),
     *              @OA\Property(property="message", type="string", example="وظیفه مورد نظر یافت نشد"),
     *           )
     *      ),
     *     @OA\Response(response=401,description="Unauthenticated",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated")
     *         )
     *     )
     * )
     */
    public function detail(int $id)
    {
        try {
            $todo = Todo::query()->where('user_id', auth()->user()->id)->findOrFail($id);
            return new DetailTodoResource($todo);
        } catch (ModelNotFoundException) {
            return BaseApiController::FailResponse(404, message: 'وظیفه انتخابی وجود ندارد');
        }

    }

    /**
     * @OA\Get(
     *     path="/api/v1/comments/todo/{id}",
     *     summary="Get list comment of a todo [Login Required]",
     *     operationId="CommentTodo",
     *     tags={"Comment"},
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(name="id",in="path",required=true,description="The ID of the Todo",
     *                  @OA\Schema(type="integer",format="int64",minimum=1,example=1)
     *     ),
     *     @OA\Response(response=200,description="Comment sent successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="لیست نظرات وظیفه مورد نظر ارسال شد"),
     *             @OA\Property(property="data", type="array",@OA\Items(ref="#/components/schemas/CommentTodoResource")),
     *             @OA\Property(property="links", type="array", @OA\Items(ref="#/components/schemas/Links")),
     *             @OA\Property(property="meta", type="array", @OA\Items(ref="#/components/schemas/Meta")),
     *         )
     *     ),
     *     @OA\Response(response=404,description="NotFound",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="string", example="fail"),
     *              @OA\Property(property="message", type="string", example="وظیفه مورد نظر یافت نشد"),
     *           )
     *      ),
     *     @OA\Response(response=401,description="Unauthenticated",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated")
     *         )
     *     )
     * )
     */
    public function commentsTodo(int $todo_id)
    {
        try {
            if (Gate::allows('adminOrOwner', Todo::query()->findOrFail($todo_id))) {
                $comments = TodoComments::query()->where('todo_id', $todo_id)->paginate(5);
                $additional = ['status' => 'success', 'message' => 'لیست نظرات ارسال شد'];
                return CommentResource::collection($comments)->additional($additional);
            } else {
                return self::FailResponse(403, 'شما مجوز لازم را ندارید');
            }
        } catch (ModelNotFoundException) {
            return self::FailResponse(404, 'وظیفه مورد نظر وجود ندارد');
        }
    }

    /**
     * @OA\Post(
     *     path="/api/v1/comment/add",
     *     summary="Adds a new comment for todo [Login Required]",
     *     operationId="CommentAdd",
     *     tags={"Comment"},
     *     security={{"sanctum": {}}},
     *
     *     @OA\RequestBody(required=true, description="Add new comment",
     *         @OA\JsonContent(
     *             @OA\Property(property="todo_id", type="integer", minimum=1,example="20"),
     *             @OA\Property(property="content_comment", type="string",minLength=5,example="this is test comment."),
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Comment added successfully",
     *         @OA\JsonContent(
     *              @OA\Property(property="status", example="success"),
     *              @OA\Property(property="message", example="نظر شما ثبت شد"),
     *              ),
     *      ),
     * @OA\Response(response=401,description="Unauthenticated",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated")
     *         )
     *     ),
     * @OA\Response(response=403,description="Forbidden",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="string", example="fail"),
     *              @OA\Property(property="message", type="string", example="شما مجوز لازم را ندارید"),
     *          )
     *      ),
     * @OA\Response(response=422,description="Validation Error",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="fail"),
     *             @OA\Property(property="message", type="string", example="اطلاعات وارد شده نامعتبر است"),
     *             @OA\Property(property="errors", type="object",
     *                 @OA\Property(property="todo_id", type="array", @OA\Items(type="string", example="متن خطای مربوط به این فیلد")),
     *                 @OA\Property(property="content_comment", type="array", @OA\Items(type="string", example="متن خطای مربوط به این فیلد"))
     *             )
     *         )
     *     ),
     * )
     */
    public function commentAdd(CommentAddRequest $request)
    {
        try {
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
        } catch (ModelNotFoundException) {
            return self::FailResponse(404, 'وظیفه موردنظر وجود ندارد');
        }
    }


    /**
     * @OA\Delete(
     *     path="/api/v1/comment/{id}",
     *     summary="Delete a Comment [Login Required]",
     *     operationId="CommentDelete",
     *     tags={"Comment"},
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(name="id",in="path",required=true,description="The ID of the Comment",
     *                   @OA\Schema(type="integer",format="int64",minimum=1,example=1)
     *      ),
     *     @OA\Response(response=200,description="Comment Deleted successfully",
     *         @OA\JsonContent(
     *              @OA\Property(property="status", example="success"),
     *              @OA\Property(property="message", example="نظر شما حذف شد"),
     *          ),
     *      ),
     * @OA\Response(response=401,description="Unauthenticated",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated")
     *         )
     *     ),
     * @OA\Response(response=404,description="NotFound",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", example="fail"),
     *               @OA\Property(property="message", example="نظری برای حذف وجود ندارد"),
     *          )
     *      ),
     * @OA\Response(response=403,description="Forbidden",
     *           @OA\JsonContent(
     *               @OA\Property(property="status", example="fail"),
     *               @OA\Property(property="message", example="شما مجوز لازم را ندارید"),
     *           )
     *       ),
     * )
     */
    public function commentRemove(int $todo_id)
    {
        // just admin can delete comments
        try {
            if (Gate::allows('isAdmin', auth()->user())) {
                TodoComments::query()->findOrFail($todo_id)->delete();
                return BaseApiController::successResponse(200, 'نظر حذف شد');
            } else {
                return self::FailResponse(403, 'شما مجوز لازم را ندارید');
            }
        } catch (ModelNotFoundException) {
            return self::FailResponse(404, 'نظری برای حذف وجود ندارد');

        }
    }
}
