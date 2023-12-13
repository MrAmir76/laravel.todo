<div class="form-group row">
    <label for="input3" class="form-label col-12">مهلت انجام(روز)</label>
    <div class="col-12">
        <input type="number" class="form-control" id="input3" name="todo-deadline"
               @cannot('AdminEditTodo', $task)disabled @endcan value="{{$task->deadline}}" required>
        @error('todo-deadline')
        <x-error-form :message="$message"/>
        @enderror
    </div>

</div>
