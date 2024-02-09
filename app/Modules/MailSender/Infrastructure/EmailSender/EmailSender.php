<?php

namespace App\Modules\MailSender\Infrastructure\EmailSender;

use App\Modules\MailSender\Domain\EmailSenderInterface;
use App\Modules\MailSender\Infrastructure\Mailable\EmailSend;
use Illuminate\Support\Facades\Mail;

class EmailSender implements EmailSenderInterface
{

    /**
     * @param string $toEmail
     * @param string $text
     * @return void
     */
    public function sendEmail(string $toEmail, string $text)
    {
        Mail::to($toEmail)->send(new EmailSend());
    }
}
