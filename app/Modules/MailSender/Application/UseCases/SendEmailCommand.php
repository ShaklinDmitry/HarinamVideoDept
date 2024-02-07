<?php

namespace App\Modules\MailSender\Application\UseCases;

use App\Modules\MailSender\Domain\EmailSenderInterface;

class SendEmailCommand implements SendEmailCommandInterface
{
    /**
     * @param EmailSenderInterface $emailSender
     */
    public function __construct(private EmailSenderInterface $emailSender)
    {
    }

    /**
     * @param string $toEmail
     * @param string $text
     * @return mixed|void
     */
    public function execute(string $toEmail, string $text)
    {
        $this->emailSender->sendEmail($toEmail, $text);
    }
}
