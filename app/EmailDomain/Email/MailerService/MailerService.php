<?php

namespace App\EmailDomain\Email\MailerService;

use App\EmailDomain\Email\MailerService\Mails\SendCodeEmail;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MailerService implements MailerServiceInterface
{
    /**
     * @param string $email
     * @param string $code
     * @return void
     */
    public function sendCodeEmail(string $email, string $code): void
    {
        $subscriber = Subscriber::create([
                'email' => $email
            ]
        );

        if ($subscriber) {
            Log::info("Sending code email to $email, $code");
            Mail::to($email)->send(new SendCodeEmail($email, $code));
        }
    }
}
