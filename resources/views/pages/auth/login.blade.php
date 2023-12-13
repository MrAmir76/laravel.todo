@extends('layouts.guest')
@section('title','ورود به حساب کاربری')
@section('body')
    <x-laravel.auth-session-status class="mb-4" :status="session('status')"/>
    <form method="POST" action="{{ route('login') }}">@csrf
        <div>
            <x-laravel.input-label for="email" value="ایمیل"/>
            <x-laravel.text-input id="email" class="block mt-1 w-full"
                                  type="email" name="email" :value="old('email')"
                                  required autofocus autocomplete="username"/>
            <x-laravel.input-error :messages="$errors->get('email')" class="mt-2"/>
        </div>

        <div class="mt-4">
            <x-laravel.input-label for="password" value="گذرواژه"/>
            <x-laravel.text-input id="password" class="block mt-1 w-full" type="password"
                                  name="password" required autocomplete="current-password"/>

            <x-laravel.input-error :messages="$errors->get('password')" class="mt-2"/>
        </div>
        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900
                dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2
                focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                   href="{{ route('password.request') }}"> گذرواژه خود را فراموش کرده‌اید؟
                </a>
            @endif
            <x-laravel.primary-button class="ml-3 mr-1">ورود</x-laravel.primary-button>
        </div>
    </form>
@endsection
