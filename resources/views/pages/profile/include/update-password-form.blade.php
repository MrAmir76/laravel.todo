<section>
    <header>
        <h4 class="text-lg text-success"> بروزرسانی گذرواژه</h4>
        <small class="mt-1 text-sm text-secondary">
            اطمینان حاصل کنید که حساب شما از یک رمز عبور طولانی و تصادفی برای حفظ امنیت استفاده می کند.
        </small>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">@csrf @method('put')
        <div>
            <label style="width: 112px" for="current_password">رمزعبور فعلی:</label>
            <input id="current_password" name="current_password" type="password" required
                   class="mt-1 block w-full" autocomplete="current-password"/>
            <x-laravel.input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2"/>
        </div>

        <div>
            <label style="width: 112px" for="password">رمز عبور جدید:</label>
            <input id="password" name="password" type="password" class="mt-1 block w-full" required
                   autocomplete="new-password"/>
            <x-laravel.input-error :messages="$errors->updatePassword->get('password')" class="mt-2"/>
        </div>

        <div>
            <label style="width: 112px" for="password_confirmation">تکرار رمزعبور:</label>
            <input id="password_confirmation" name="password_confirmation" required
                   type="password" class="mt-1 block w-full" autocomplete="new-password"/>
            <x-laravel.input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2"/>
        </div>

        <div class="flex items-center gap-4">
            <input type="submit" value="بروزرسانی" class="btn btn-outline-dark mt-2">
            @if (session('status') === 'password-updated')
                <small
                    class="text-sm text-gray-600 text-success">رمزعبور بروزرسانی شد.
                </small>
            @endif
        </div>
    </form>
</section>
