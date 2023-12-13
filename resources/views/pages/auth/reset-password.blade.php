@extends('layouts.guest')
@section('title','بازنشانی رمزعبور')
@section('body')
    <form method="POST" action="{{ route('password.store') }}">@csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <div>
            <x-laravel.input-label for="email" value="ایمیل"/>
            <x-laravel.text-input id="email" class="block mt-1 w-full" type="email" name="email"
                          :value="old('email', $request->email)" required autofocus
                          autocomplete="username"/>
            <x-laravel.input-error :messages="$errors->get('email')" class="mt-2"/>
        </div>
        <div class="mt-4">
            <x-laravel.input-label for="password" value="رمز عبور"/>
            <x-laravel.text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                          autocomplete="new-password"/>
            <x-laravel.input-error :messages="$errors->get('password')" class="mt-2"/>
        </div>
        <div class="mt-4">
            <x-laravel.input-label for="password_confirmation" value="تکرار رمزعبور"/>

            <x-laravel.text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                          name="password_confirmation" required autocomplete="new-password"/>
            <x-laravel.input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
        </div>
        <div class="flex items-center justify-end mt-4">
            <x-laravel.primary-button>بازنشانی رمزعبور</x-laravel.primary-button>
        </div>
    </form>
@endsection
