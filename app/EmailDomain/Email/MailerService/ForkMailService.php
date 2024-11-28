<?php

namespace App\EmailDomain\Email\MailerService;

use App\EmailDomain\Email\MailerService\Mails\SendCodeEmail;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Mail;

class ForkMailService implements MailerServiceInterface
{

    public function sendCodeEmail(string $email, string $code): void
    {
        $pid = pcntl_fork();

        if ($pid == -1) {
            // Fork failed
            die('Could not fork the process.');
        } elseif ($pid) {
            // Parent process - continue executing the main script
//            echo "Parent process continuing. Child PID: $pid\n";
            return;
        } else {
            // Child process - execute the command asynchronously

            $subscriber = Subscriber::create([
                    'email' => $email
                ]
            );

            if ($subscriber) {
                Mail::to($email)->send(new SendCodeEmail($email, $code));
            }

            exit(0);
        }
    }
}