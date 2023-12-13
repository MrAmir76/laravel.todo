<div class="form-group row">
    <label for="input2" class="col-sm-12 col-form-label">شرح مسئولیت</label>
    <div class="col-sm-12">
        <textarea class="form-control" id="input2" rows='5' name="todo-body"
                  @cannot('AdminEditTodo', $task)disabled @endcan required>{{$task->content}}</textarea>
        @error('todo-body')
        <x-error-form :message="$message"/>
        @enderror
    </div>
</div>
