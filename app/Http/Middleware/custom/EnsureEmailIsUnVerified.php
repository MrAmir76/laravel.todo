<?php

namespace App\Http\Middleware\custom;

use App\Http\Controllers\Api\V1\BaseApiController;
use Closure;
use Illuminate\Http\Request;

class EnsureEmailIsUnVerified
{

    public function handle(Request $request, Closure $next)
    {
        $VerifiedEmail = optional($request->user())->hasVerifiedEmail();

        if (!$VerifiedEmail) {
            return $next($request);
        } else {

            if ($request->expectsJson()) {
                $message = 'شما قبلا ایمیل خود را تاییید کرده کرده‌اید';
                return BaseApiController::FailResponse(400, $message);
            } else {
                return redirect()->route('profile.index');
            }
        }
    }
}
