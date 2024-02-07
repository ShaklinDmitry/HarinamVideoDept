<?php

namespace Tests\Feature;

use App\Modules\MailSender\Application\UseCases\SendEmailCommandInterface;
use App\Modules\MailSender\Infrastructure\Mailable\EmailSend;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class SendEmailCommandTest extends TestCase
{

    public function test_send_email_command(){

        Mail::fake();

        $sendEmailCommandInterface = app(SendEmailCommandInterface::class);

        $toEmail = "test@mail.ru";
        $text = 'test text';

        $sendEmailCommandInterface->execute($toEmail, $text);

        Mail::assertSent(EmailSend::class);
    }
}
