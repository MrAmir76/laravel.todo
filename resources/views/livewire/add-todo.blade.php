<div class="card p-1 mb-5">@php($user = auth()->user())
    @include('include.alert')
    <div class="card-header font-weight-bold mb-3">
        افزودن وظیفه جدید
        <button class="float-left btn-outline-danger close-btn"
                id="closeBtn" onclick="closeNewTask()">بستن
        </button>
    </div>
    <div class="container" id="closeNewTask" style="display: block">
        @include('include.AddTodo.form')
    </div>
    @include('include.script.closeOpenNewTaskScript')
</div>
