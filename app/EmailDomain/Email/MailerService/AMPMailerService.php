<?php

namespace App\EmailDomain\Email\MailerService;

use App\EmailDomain\Email\MailerService\Mails\SendCodeEmail;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AMPMailerService implements MailerServiceInterface
{
    /**
     * @inheritDoc
     */
    public function sendCodeEmail(string $email, string $code): void
    {
        $ampPool = \Amp\async(function () use ($email, $code) {
            $subscriber = Subscriber::create([
                    'email' => $email
                ]
            );

            if ($subscriber) {
                Mail::to($email)->send(new SendCodeEmail($email, $code));
            }
        });


        $ampPool->catch(function (\Exception $exception) {
            Log::error($exception->getMessage());
        });

        $ampPool->await();
    }
}