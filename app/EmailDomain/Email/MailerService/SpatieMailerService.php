<?php

namespace App\EmailDomain\Email\MailerService;

use App\EmailDomain\Email\MailerService\Mails\SendCodeEmail;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Spatie\Async\Pool;

class SpatieMailerService implements MailerServiceInterface
{
    /**
     * @inheritDoc
     */
    public function sendCodeEmail(string $email, string $code): void
    {//
        Pool::create()->add(function () use ($email, $code) {
                $subscriber = Subscriber::create([
                        'email' => $email
                    ]
                );

            if ($subscriber) {
                    Mail::to($email)->send(new SendCodeEmail($email, $code));
                }
            })->then(function () {

        })->catch(function (\Exception $exception) {
            Log::error($exception->getMessage());
        });
    }
}