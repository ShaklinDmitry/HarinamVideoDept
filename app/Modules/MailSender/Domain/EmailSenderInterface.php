<?php

namespace App\Modules\MailSender\Domain;

interface EmailSenderInterface
{

    /**
     * @param string $toEmail
     * @param string $text
     * @return mixed
     */
    public function sendEmail(string $toEmail, string $text);
}
