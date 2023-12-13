@extends('layouts.app')
@section('title','جزئیات کاربر'.  " " . $user->name)
@section('body')
    @include('include.alert')
    <form method="post"
          action="{{route($user->email_verified_at===null? 'profile.updateUserUnVerify':'profile.updateUserVerify')}}"
          class="p-3">@csrf @method('PUT')
        <input type="hidden" name="id" value="{{Crypt::encrypt((2*$user->id)+1)}}">
        <div class="row">
            <div class="col">
                <label class="text-black-50">نام کاربر:
                    <input type="text" class="form-control mt-2" name="name" value="{{$user->name}}">
                    @error('name')
                    <x-error-form :message="$message"/>
                    @enderror
                </label>
            </div>
            <div class="col">
                <label class="text-black-50">ایمیل کاربر:
                    <input type="text" class="form-control mt-2" name="email" value="{{$user->email}}">
                    @error('email')
                    <x-error-form :message="$message"/>
                    @enderror
                </label>
            </div>
            <div class="col mt-4">
                <input class="form-check-input" type="checkbox" id="isAdmin"
                       value="1" name="isAdmin" {{$user->admin===1 ? 'checked' : '' }}>
                <label class="form-check-label text-black-50" for="isAdmin"> کاربر مدیر است؟</label><br>
                @error('isAdmin')
                <x-error-form :message="$message"/>
                @enderror
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                @if($user->email_verified_at === null)
                    <div class="col" style="float: right">
                        <input class="form-check-input" type="checkbox" value="1" id="verifyAccount"
                               name="verifyAccount">
                        <label class="form-check-label text-black-50" for="verifyAccount"> تایید حساب؟</label><br>
                        @error('verifyAccount')
                        <x-error-form :message="$message"/>
                        @enderror
                    </div>
                @else
                    <label class="text-black-50" style="float: right">تاریخ تایید حساب:
                        <input type="text" class="form-control mt-2" disabled style="direction: rtl"
                               value="{{\App\helper\Jalali::convert($user->email_verified_at)}}">
                    </label>
                @endif
                <button type="submit" class="btn btn-success mt-4 ml-5" style="float: left"> بروزرسانی</button>
            </div>
        </div>
    </form>
@endsection
