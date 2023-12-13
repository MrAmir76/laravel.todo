<div class="form-group row">
    <label for="Select2" class="col-sm-10 col-form-label">وضعیت نهایی(برسی مدیریت)</label>
    <div class="col-sm-12">
        <select class="form-control" id="Select2" name="status-finally"
                @cannot('AdminEditTodo', $task)disabled @endcan >
            <option value="1" {{ $task->finally_status=== 1 ? 'selected': '' }}>موفقیت آمیز</option>
            <option value="0" {{ $task->finally_status === 0 ? 'selected': '' }}>شکست خورد</option>
            <option value="" {{ $task->finally_status === null ? 'selected': ''}}>نامشخص</option>
        </select>
        @error('status-finally')
        <x-error-form :message="$message"/>
        @enderror
    </div>
</div>
