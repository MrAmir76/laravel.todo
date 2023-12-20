<form wire:submit.prevent="save">
    <div class="form-group row">
        <label for="input1" class="col-sm-3 col-md-2 col-form-label">عنوان وظیفه</label>
        <div class="col-sm-9 col-md-10">
            <input type="text" class="form-control" id="input1"
                   wire:model.live.debounce.1s="taskTitle" required>
            @error('taskTitle')
            <x-error-form :message="$message"/>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="input2" class="col-sm-3 col-md-2 col-form-label">شرح مسئولیت</label>
        <div class="col-sm-9 col-md-10">
            <textarea class="form-control" id="input2" rows="3" wire:model.live.debounce.1s="taskBody"
                      required></textarea>
            @error('taskBody')
            <x-error-form :message="$message"/>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="input3" class="col-sm-2   col-form-label">مهلت انجام</label>
        <div class="col-10 mb-1">
            <input type="number" class="form-control " required
                   placeholder="روز" id="input3" wire:model.live.debounce.1s="taskDeadline">
            @error('taskDeadline')
            <x-error-form :message="$message"/>
            @enderror
        </div>
        @if($user->admin==1)
            <label for="Select1" class="col-sm-2 col-form-label">انجام دهنده</label>
            <div class="col-10">
                <select class="form-control" id="Select1" wire:model.live.debounce.1s="operator_">
                    <option hidden>انتخاب کنید</option>
                    @foreach($userList as $key => $value)
                        @if($key==$user->id)
                            <option value="{{$user->id}}">خودم</option>
                        @else
                            <option value="{{$key}}">{{$value}}</option>
                        @endif
                    @endforeach
                </select>
                @error('operator_')
                <x-error-form :message="$message"/>
                @enderror
            </div>
        @endif
    </div>
    <div class="form-group row">
        <label for="input4" class="col-sm-2 col-form-label">نتیجه کار</label>
        <div class="col-sm-10">
            <textarea placeholder="توسط خود فرد" class="form-control" id="input4" rows="3"
                      wire:model.live.debounce.1s="resultSelf"></textarea>
            @error('resultSelf')
            <x-error-form :message="$message"/>
            @enderror
        </div>
    </div>
    @if($showNewTaskBtn)
        <button type="submit" class="btn btn-primary mb-3 float-left">ایجاد وظیفه</button>
    @endif
</form>
