<?php

namespace App\EmailDomain\Email\MailerService;

use App\EmailDomain\Email\MailerService\Jobs\SendCodeToMail;

class QueueMailerService implements MailerServiceInterface
{
    public function sendCodeEmail(string $email, string $code): void
    {
        dispatch(new SendCodeToMail($email, $code))
            ->onConnection('database')
            ->onQueue('mail_code');
    }
}