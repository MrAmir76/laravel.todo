<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;

class OtpCodeEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $deadline;
    private $code;
    private $siteName;
    private $header;


    public function __construct($deadline, $code, $siteName, $header, $subject)
    {
        $this->deadline = $deadline;
        $this->code = $code;
        $this->siteName = $siteName;
        $this->header = $header;
        $this->subject = $subject;
    }


    public function content()
    {
        $data = [
            'time' => $this->deadline,
            'code' => $this->code,
            'siteName' => $this->siteName,
            'header' => $this->header,
        ];

        return new Content('email.otp-code', null, null, null, $data);
    }
}
