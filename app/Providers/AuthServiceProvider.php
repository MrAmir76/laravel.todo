<?php

namespace App\Providers;

use App\Models\Todo;
use App\Models\User;
use App\Policies\AdminPolicy;
use App\Policies\EditTodoPolicy;
use App\Policies\TodoPolicy;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;

class AuthServiceProvider extends ServiceProvider
{


    protected $policies = [
        Todo::class => TodoPolicy::class,
        User::class => AdminPolicy::class
    ];

    public function boot()
    {


        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->subject('تایید نشانی ایمیل')
                ->line('برای تایید آدرس ایمیل خود روی دکمه زیر کلیک کنید.')
                ->action('تایید نشانی ایمیل', $url);
        });

        ResetPassword::toMailUsing(function ($notifiable, $url) {

            return (new MailMessage)
                ->subject('بازنشانی رمز عبور')
                ->line('شما این ایمیل را دریافت می کنید زیرا ما یک درخواست بازنشانی رمز عبور برای حساب شما دریافت کردیم.')
                ->action('بازنشانی رمز عبور', route('password.reset', [$url]))
                ->line('این پیوند بازنشانی رمز عبور در ' . config('auth.passwords.' . config('auth.defaults.passwords') . '.expire') . ' دقیقه دیگر منقضی می شود.')
                ->line("اگر بازنشانی رمز عبور را درخواست نکردید، هیچ اقدام دیگری لازم نیست\n");
        });
    }
}
