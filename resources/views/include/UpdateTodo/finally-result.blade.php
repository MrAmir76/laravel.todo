<div class="form-group row">
    <label for="input5" class="col-sm-12 col-form-label">توضیحات نتیجه نهایی</label>
    <div class="col-sm-12">
        <textarea placeholder="توسط مدیریت" class="form-control" id="input5" name="finally-result" rows="3"
                  @cannot('AdminEditTodo', $task)disabled @endcan>{{$task->finally_result}}</textarea>
        @error('finally-result')
        <x-error-form :message="$message"/>
        @enderror
    </div>
</div>
