<div class="m-auto" style="width: 95%">@php($user = auth()->user())
    @include('include.alert')
    <div class="card-header" style="height: 56px;margin-top: 5px">
        <h5 class="float-right">جزئیات وظیفه شماره
            {{$id}}
        </h5>
        <div class="todoAction">
            <a href="{{route('index')}}" class="btn btn-info float-left">برگشت</a>
            <a class="btn btn-danger float-left ml-2 text-shadow text-white deleteTodo"
               onclick="openConfirmDeleteTodo()">حذف</a>
        </div>
    </div>
    <div class="card-body">
        @include('include.UpdateTodo.update-todo-form')
    </div>
    <livewire:DeleteTodo :id="$id"/>
</div>
