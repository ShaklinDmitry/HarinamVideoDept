<?php

namespace App\Modules\MailSender\Application\UseCases;

interface SendEmailCommandInterface
{
    /**
     * @param string $toEmail
     * @param string $text
     * @return mixed
     */
    public function execute(string $toEmail, string $text);

}
