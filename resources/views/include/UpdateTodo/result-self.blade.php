<div class="form-group row">
    <label for="input4" class="col-sm-12 col-form-label">نتیجه کار</label>
    <div class="col-sm-12">
        <textarea placeholder="توسط خود فرد" class="form-control" id="input4" name="resultSelf" rows="3"
                  @cannot('EditTodo', $task)disabled @endcan>{{$task->result}}</textarea>
        @error('resultSelf')
        <x-error-form :message="$message"/>
        @enderror
    </div>
</div>
