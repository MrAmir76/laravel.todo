@extends('layouts.guest')
@section('title', 'فراموشی گذرواژه')
@section('body')
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        رمز عبور خود را فراموش کرده اید؟ لطفا ایمیلی که با آن ثبت‌نام کردید را وارد کنید تا
        ما یک پیوند بازنشانی رمز عبور را برای شما ارسال کنیم.
    </div>
    <x-laravel.auth-session-status class="mb-4" :status="session('status')"/>
    <form method="POST" action="{{ route('password.email') }}"> @csrf
        <div>
            <x-laravel.input-label for="email" value="ایمیل"/>
            <x-laravel.text-input id="email" class="block mt-1 w-full" type="email"
                                  name="email" :value="old('email')" required autofocus/>
            <x-laravel.input-error :messages="$errors->get('email')" class="mt-2"/>
        </div>
        <div class="flex items-center justify-end mt-4">
            <x-laravel.primary-button>درخواست ایمیل بازیابی رمزعبور</x-laravel.primary-button>
        </div>
    </form>
@endsection
