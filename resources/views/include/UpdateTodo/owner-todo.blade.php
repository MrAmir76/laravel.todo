<label for="Select1" class="col-12 col-form-label">انجام دهنده</label>
<select class="form-control col-12" id="Select1" disabled>
    @php($user= \App\Models\User::findOrFail($task->user_id)->name)
    <option selected>{{$user}}</option>
</select>
