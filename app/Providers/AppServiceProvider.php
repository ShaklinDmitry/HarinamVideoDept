<?php

namespace App\Providers;

use App\Modules\MailSender\Application\UseCases\SendEmailCommand;
use App\Modules\MailSender\Application\UseCases\SendEmailCommandInterface;
use App\Modules\MailSender\Domain\EmailSenderInterface;
use App\Modules\MailSender\Infrastructure\EmailSender\EmailSender;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(EmailSenderInterface::class, function (){
            return new EmailSender();
        });

        $this->app->bind(SendEmailCommandInterface::class, function (){
            $emailSender = app(EmailSenderInterface::class);
            return new SendEmailCommand($emailSender);
        });
    }
}
