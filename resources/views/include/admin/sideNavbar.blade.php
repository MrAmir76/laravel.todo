@auth()
    <aside class="col-lg-3 col-md-4 col-12 side float-end height-100">
        <x-admin-box-user-info name="{{$user->name}}" email="{{$user->email}}" created="{{$user->created_at}}"/>
        <x-admin-nav-link name="خانه" link="{{route('index')}}" font="fa fa-house"/>
        <x-admin-nav-link name="کاربران" link="{{route('profile.user')}}" font="fa fa-users"/>
        <x-admin-nav-link name="خروج" link="{{route('logout')}}" font="fa fa-sign-out"/>
    </aside>
    <div class="col-lg-9 col-md-8 content float-start col-12 height-100">@yield('body')</div>
@endauth
