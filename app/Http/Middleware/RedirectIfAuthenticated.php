<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Api\V1\BaseApiController;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if ($request->expectsJson()) {
                    return BaseApiController::FailResponse(403, 'شما قبلا وارد شده اید');
                } else {
                    return redirect(RouteServiceProvider::HOME);
                }
            }
        }
        return $next($request);
    }
}
