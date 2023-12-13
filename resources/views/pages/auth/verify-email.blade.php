@extends('layouts.guest')
@section('title','تایید حساب کاربری(ایمیل)')
@section('body')
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        لطفا برای ادامه کار و استفاده از تمامی امکانات این سامانه ایمیل خود را تایید کنید.
        اگر ایمیلی را دریافت نکردید، دوباره درخواست دهید.
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            یک پیوند تأیید جدید به آدرس ایمیلی که هنگام ثبت نام ارائه کرده اید ارسال شده است.
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">@csrf
            <div>
                <x-laravel.primary-button>
                    ایمیل تایید را دوباره ارسال کن
                </x-laravel.primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">@csrf
            <button type="submit"
                    class="underline text-sm text-gray-600 dark:text-gray-400
                     hover:text-gray-900 dark:hover:text-gray-100 rounded-md
                     focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500
                      dark:focus:ring-offset-gray-800">
                خروج
            </button>
        </form>
    </div>
@endsection
