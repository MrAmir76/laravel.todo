@extends('layouts.guest')
@section('title','تایید رمزعبور')
@section('body')
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400"> لطفاً برای ادامه رمز عبور خود را تأیید کنید.</div>
    <form method="POST" action="{{ route('password.confirm') }}">@csrf
        <div>
            <x-laravel.input-label for="password" value="رمزعبور"/>

            <x-laravel.text-input id="password" class="block mt-1 w-full"
                                  type="password" name="password" required autocomplete="current-password"/>
            <x-laravel.input-error :messages="$errors->get('password')" class="mt-2"/>
        </div>
        <div class="flex justify-end mt-4">
            <x-laravel.primary-button>تایید</x-laravel.primary-button>
        </div>
    </form>
@endsection
