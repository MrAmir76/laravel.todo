<form method="post" action="{{route( $user->admin ? 'updateTodoAdmin':'updateTodo',['id'=>$task->id])}}">
    @csrf @method('PUT')
    @include('include.UpdateTodo.title-todo')
    @include('include.UpdateTodo.body-todo')
    @include('include.UpdateTodo.deadline-todo')
    @include('include.UpdateTodo.owner-todo')
    @include('include.UpdateTodo.result-self')

    @include('include.UpdateTodo.finally-result')
    @include('include.UpdateTodo.status-finally')
    @can('EditTodo', $task)
        <button type="submit" class="btn btn-primary mb-3 float-left">بروزرسانی</button>
    @endcan
</form>
