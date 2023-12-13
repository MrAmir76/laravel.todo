<div class="form-group row titleTodo">
    <label for="input1" class="col-sm-12 col-form-label">عنوان مسئولیت</label>
    <div class="col-sm-12">
        <input type="text" class="form-control" id="input1" value="{{$task->title}}" name="todo-title"
               @cannot('AdminEditTodo', $task) disabled @endcan  required>
        @error('todo-title')
        <x-error-form :message="$message"/>
        @enderror
    </div>
</div>
