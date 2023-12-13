<div class="card m-3" style="border-radius: 4px">
    <div class="card-header font-weight-bold mb-3"> کاربرها</div>
    <table class="table m-auto table-striped p-1 " style="width: 95%;">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">نام</th>
            <th scope="col">ایمیل</th>
            <th scope="col">نوع کاربری</th>
            <th scope="col">تایید شده</th>
            <th scope="col">ایجاده شده</th>
            <th scope="col">عملیات</th>
        </tr>
        </thead>
        @if(!empty($users))
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->admin?'مدیر':'کاربرعادی'}}</td>
                    <td>{{$user->email_verified_at!=null ?'بله':'خیر'}}</td>
                    <td>{{\App\helper\Jalali::convert1($user->created_at)}}</td>
                    <td><a href="{{route('profile.detail',['id'=>$user->id])}}" class="btn btn-info"> ویرایش</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        @endif
    </table>
    @if(!empty($users))
        <div style="margin: 5px auto">
            {{$users->onEachSide(2)->links()}}
        </div>
    @endif
</div>
