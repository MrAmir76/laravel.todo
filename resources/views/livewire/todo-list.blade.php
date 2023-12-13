<div class="card" style="overflow-x: auto">
    <div class="card-header font-weight-bold mb-3 todoListHeader"> کارهای من</div>
    <table class="table m-auto table-striped p-1 " style="width: 95%;">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">عنوان</th>
            <th scope="col">شرح وظیفه</th>
            <th scope="col">تاریخ ابلاغ</th>
            <th scope="col">مهلت انجام(روز)</th>
            <th scope="col">نتیجه</th>
            <th scope="col">جزئیات</th>
        </tr>
        </thead>
        @if(!empty($todo))
            <tbody>
            @foreach($todo as $_todo)
                <tr wire:key="{{$_todo->id}}">
                    <td>{{$_todo->id}}</td>
                    <td>{{substr($_todo->title,0,26)}}</td>
                    <td>{{substr($_todo->content,0,26)}}</td>
                    <td>{{\App\helper\Jalali::convert1($_todo->created_at)}}</td>
                    <td> {{$_todo->deadline}}</td>
                    <td>
                <span class="btn btn-dark text-white">
                    @if($_todo->finally_status===1)
                        انجام شده
                    @elseif($_todo->finally_status===0)
                        شکست خورده
                    @elseif($_todo->finally_status === null)
                        نامشخص
                    @endif
                </span>
                    </td>
                    <td>
                        <a href="{{route('detailTodo',['id'=>$_todo->id])}}" class="btn btn-info">مشاهده</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        @endif
    </table>
    @if(!empty($todo))
        <div style="margin: 5px auto">
            {{$todo->onEachSide(2)->links()}}
        </div>
    @endif
</div>
