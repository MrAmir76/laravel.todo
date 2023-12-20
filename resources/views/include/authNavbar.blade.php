@auth()
    @can('isAdmin',auth()->user())
        <li class="nav-item">
            <a class="nav-link" href="{{route('profile.index')}}">مدیریت سایت</a>
        </li>
    @endcan
    <li class="nav-item">
        <a class="nav-link btn"
           x-data="{ sowSearch: ()=>{document.getElementById('advanceSearch').style.display ='block'} }"
           @click="sowSearch()">
            جستوجو
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('logout')}}">خروج</a>
    </li>
@else

    <li class="nav-item">
        <a class="nav-link" href="{{route('login')}}">ورود</a>
    </li>

    <li class="nav-item" style="margin-top: 2px">
        <a class="nav-link" href="{{route('register')}}">ثبت نام</a>
    </li>

@endauth

