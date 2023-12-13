<?php


namespace App\helper\Api;


use App\helper\Jalali;
use App\Mail\OtpCodeEmail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class EmailHelper
{
    private $deadline;
    private $siteName;
    private $newCode;
    private $header;
    private $user;
    private $subject;

    public function __construct($user, $header, $subject)
    {
        $this->deadline = env('OTP_CODE_TIME_LIFE');
        $this->siteName = env('APP_FNAME');
        $this->newCode = rand(10000, 99999);
        $this->header = $header;
        $this->user = $user;
        $this->subject = $subject;
    }

    public function SendOtpCode()
    {

        DB::transaction(function () use (&$created_at) {
            // اگه کدی از قبل وجود داره حذف و کد جدیدی ایجاد کن.
            DB::table('otp_code')
                ->where('user_id', $this->user->id)
                ->delete();

            $recordId = DB::table('otp_code')
                ->insertGetId(['user_id' => $this->user->id, 'otp' => $this->newCode]);

            $created_at = DB::table('otp_code')
                ->where('id', $recordId)
                ->value('created_at');
        });

        $expire = Carbon::parse($created_at)
            ->addMinutes($this->deadline)
            ->format('Y-m-d H:i:s');

        $jalaliExpire = Jalali::convert($expire);

        Mail::to($this->user)
            ->send(new OtpCodeEmail(
                    $jalaliExpire,
                    $this->newCode,
                    $this->siteName,
                    $this->header,
                    $this->subject)
            );
    }
}
