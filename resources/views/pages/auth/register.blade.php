@extends('layouts.guest')
@section('title','ثبت‌نام کاربر جدید')
@section('body')
    <form method="POST" action="{{ route('register') }}">@csrf
        <div>
            <x-laravel.input-label for="name" value="نام"/>
            <x-laravel.text-input id="name" class="block mt-1 w-full" type="text"
                                  name="name" :value="old('name')" required autofocus autocomplete="name"/>
            <x-laravel.input-error :messages="$errors->get('name')" class="mt-2"/>
        </div>
        <div class="mt-4">
            <x-laravel.input-label for="email" value="ایمیل"/>
            <x-laravel.text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                  :value="old('email')" required autocomplete="username"/>
            <x-laravel.input-error :messages="$errors->get('email')" class="mt-2"/>
        </div>
        <div class="mt-4">
            <x-laravel.input-label for="password" value="رمزعبور"/>
            <x-laravel.text-input id="password" class="block mt-1 w-full"
                                  type="password" name="password"
                                  required autocomplete="new-password"/>
            <x-laravel.input-error :messages="$errors->get('password')" class="mt-2"/>
        </div>
        <div class="mt-4">
            <x-laravel.input-label for="password_confirmation" value="تکرار رمزعبور"/>
            <x-laravel.text-input id="password_confirmation" class="block mt-1 w-full"
                                  type="password" name="password_confirmation"
                                  required autocomplete="new-password"/>
            <x-laravel.input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
        </div>
        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900
            dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2
             focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
               href="{{ route('login') }}">قبلا ثبت‌نام کرده‌اید؟
            </a>
            <x-laravel.primary-button class="ml-4 mr-1">ثبت‌نام</x-laravel.primary-button>
        </div>
    </form>
@endsection
