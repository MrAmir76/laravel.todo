<?php

namespace App\Http\Controllers\Api\V1;

use App\Exceptions\Api\CustomException;
use App\helper\Api\EmailHelper;
use App\Http\Requests\Api\V1\ChangePasswordRequest;
use App\Http\Requests\Api\V1\EmailRequiredRequest;
use App\Http\Requests\Api\V1\loginRequest;
use App\Http\Requests\Api\V1\ProfileEditRequest;
use App\Http\Requests\Api\V1\RegisterRequest;
use App\Http\Requests\Api\V1\SetNewPassword;
use App\Http\Requests\Api\V1\VerifyEmailRequest;
use App\Http\Resources\SuccessLoginResource;
use App\Http\Resources\SuccessRegisterResource;
use App\Http\Resources\SuccessSendVerifyEmail;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends BaseApiController
{

    public function login(LoginRequest $request)
    {
        try {
            // چک کن ایمیل با رمزعبور مطابقت دارد.
            if (!Auth::attempt($request->only(['email', 'password']))) {
                $message = 'ایمیل یا رمزعبور اشتباه می باشد';
                return self::FailResponse(401, $message);
            } else {
                $user = User::query()->where('email', $request->get('email'))->first();
                return new SuccessLoginResource($user);
            }
        } catch (Exception $e) {
            return CustomException::baseException($request, $e, 400, 'خطا در ورود به حساب کاربری');
        }
    }

    public function register(RegisterRequest $request)
    {
        try {
            $cleanData =
                $request->only('email', 'name') +
                ['password' => Hash::make($request->get('password'))];

            $user = User::query()->create($cleanData);
            return new SuccessRegisterResource($user);
        } catch (Exception $e) {
            return CustomException::baseException($request, $e, 400, 'خطا در ثبت ‌نام حساب کاربری');
        }
    }

    public function sendVerifyEmail(Request $request)
    {
        try {
            $header = 'تایید ایمیل جهت عضویت در سایت ' . env('APP_FNAME');
            $subject = 'کد تایید ایمیل';

            (new EmailHelper(Auth::user(), $header, $subject))->SendOtpCode();
            return new SuccessSendVerifyEmail(Auth::user());

        } catch (Exception $e) {
            $message = 'خطا در ارسال ایمیل تایید حساب کاربری';
            return CustomException::baseException($request, $e, 400, $message);
        }
    }

    public function VerifyEmail(VerifyEmailRequest $request)
    {
        $deadline = env('otp_code_time_life');
        $otp = DB::table('otp_code')
            ->where('user_id', optional(Auth::user())->id)
            ->where('otp', $request->get('otp_code'))
            ->where('created_at', '>=', now()->subMinutes($deadline))
            ->first();
        if ($otp) {
            // تایید حساب کاربری
            User::query()
                ->findOrFail(optional(Auth::user())->id)
                ->update(['email_verified_at' => now()]);

            // حذف تمامی کدهای یکبار مصرف کاربر
            DB::table('otp_code')
                ->where('user_id', optional(Auth::user())->id)
                ->delete();

            $message = 'حساب کاربری شما تایید شد';
            return self::successResponse(200, $message);


        } else {
            $message = 'کد واردشده اشتباه می باشد';
            return self::FailResponse(403, $message);
        }
    }

    public function restPassword(EmailRequiredRequest $request)
    {
        try {
            $email = $request->get('email');
            $user = User::query()->where('email', $email)->first();

            if ($user) {
                $header = 'بازنشانی رمزعبور حساب کاربری در سایت ' . env('APP_FNAME');
                $subject = 'بازنشانی رمزعبور';
                (new EmailHelper($user, $header, $subject))->SendOtpCode();
                $message = 'کد یکبارمصرف جهت بازنشانی رمز عبور ارسال شد.';
                return self::successResponse(200, $message);

            } else {
                $message = 'کاربری با چنین ایمیلی وجود ندارد';
                return self::FailResponse(404, $message);
            }

        } catch (Exception $exception) {
            $message = 'خطا در ارسال ایمیل بازنشانی رمزعبور';
            return CustomException::baseException($request, $exception, 400, $message);
        }


    }

    public function setNewPassword(SetNewPassword $request)
    {
        $deadline = env('otp_code_time_life');
        $user = User::query()->where('email', $request->get('email'))->first();
        if (!$user) {
            $message = 'کاربری با ایمیل وارد شده وجود ندارد';
            return self::FailResponse(404, $message);
        }

        $otp = DB::table('otp_code')
            ->where('user_id', $user->id)
            ->where('otp', $request->get('otp_code'))
            ->where('created_at', '>=', now()->subMinutes($deadline))
            ->first();
        if ($otp) {
            // تغییر رمزعبور
            $newPassword = Hash::make($request->get('password'));
            $user->update(['password' => $newPassword]);
            $user->save();

            // حذف تمامی کدهای یکبار مصرف کاربر
            DB::table('otp_code')
                ->where('user_id', $user->id)
                ->delete();

            $message = 'رمزعبور شما بازنشانی شد';
            return self::successResponse(200, $message);
        } else {
            $message = 'کد واردشده اشتباه می باشد';
            return self::FailResponse(403, $message);
        }

    }

    public function changePassword(ChangePasswordRequest $request)
    {
        try {

            $newPassword = Hash::make($request->get('password'));
            Auth::user()->update(['password' => $newPassword]);
            $message = 'رمزعبور باموفقیت تغییر کرد.';
            return self::successResponse(200, $message);
        } catch (Exception $exception) {
            $message = 'رمزعبور شما تغییر نکرد.';
            return CustomException::baseException($request, $exception, 400, $message);
        }
    }


    public function editProfile(ProfileEditRequest $request)
    {
        try {
            $user = Auth::user();
            $old_email = $user->email;
            $userData = $request->only('email', 'name');
            $user->fill($userData);

            if ($old_email != $userData['email']) {
                $user->email_verified_at = null;
            }

            $user->save();

            $message = 'پروفایل شما بروزرسانی شد.';
            return self::successResponse(200, $message);
        } catch (Exception $exception) {
            $message = 'پروفایل شما بروزرسانی نشد.';
            return CustomException::baseException($request, $exception, 400, $message);
        }
    }
}
