<?php

namespace App\EmailDomain\Email\MailerService\Jobs;

use App\EmailDomain\Email\MailerService\MailerService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;

class SendCodeToMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    public function __construct(
        private string $email,
        private string $code
    ) {
    }

    public function handle()
    {
        /*** @var MailerService $mailerService */
        $mailerService = App::make(MailerService::class);

        $mailerService->sendCodeEmail($this->email, $this->code);
    }
}