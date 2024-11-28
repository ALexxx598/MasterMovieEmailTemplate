<?php

namespace App\Providers;

use App\EmailDomain\Email\MailerService\AMPMailerService;
use App\EmailDomain\Email\MailerService\ForkMailService;
use App\EmailDomain\Email\MailerService\MailerService;
use App\EmailDomain\Email\MailerService\MailerServiceInterface;
use App\EmailDomain\Email\MailerService\QueueMailerService;
use App\EmailDomain\Email\MailerService\SpatieMailerService;
use Illuminate\Support\ServiceProvider;

class MailServiceProvider extends ServiceProvider
{
    /**
     * @inheritDoc
     */
    public function register()
    {
        $this->registerMailService();
    }

    private function registerMailService(): void
    {
        $this->app->singleton(MailerServiceInterface::class, QueueMailerService::class);
    }
}
