<section class="p-3">
    <header>
        <h4 class="text-lg text-success">
            اطلاعات نمایه
        </h4>
        <small class="mt-1 text-sm text-secondary">
            اطلاعات نمایه و آدرس ایمیل حساب خود را به روز کنید.
        </small>
    </header>
    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf @method('patch')
        <div>
            <label style="width: 45px" for="name">نام:</label>
            <input id="name" name="name" type="text" style="text-indent: 5px"
                   class="mt-1  w-full text-secondary" value="{{old('name', $user->name)}}"
                   required autofocus autocomplete="name"/>
            <x-laravel.input-error class="mt-2" :messages="$errors->get('name')"/>
        </div>

        <div>
            <label style="width: 45px" for="email">ایمیل:</label>
            <input id="email" name="email" type="email" class="mt-1 block w-full"
                   style="padding-left: 5px;text-align: left" value="{{old('email', $user->email)}}"
                   required autocomplete="username"/>
            <x-laravel.input-error class="mt-2" :messages="$errors->get('email')"/>

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        آدرس ایمیل شما تایید نشده است
                        <button form="send-verification"
                                class="underline text-sm text-gray-600 dark:text-gray-400
                                hover:text-gray-900 dark:hover:text-gray-100 rounded-md
                                focus:outline-none focus:ring-2 focus:ring-offset-2
                                focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            برای ارسال مجدد ایمیل تایید اینجا را کلیک کنید
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <small class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            یک پیوند تأیید جدید به آدرس ایمیل شما ارسال شده است.
                        </small>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <input type="submit" class="btn btn-outline-dark mt-2" value="بروزرسانی">

            @if (session('status') === 'profile-updated')
                <small class="text-sm text-gray-600 text-success">
                    اطلاعات کاربری بروزرسانی
                </small>
            @endif
        </div>
    </form>
</section>
