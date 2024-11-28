<?php

namespace App\EmailDomain\Email\MailerService;

interface MailerServiceInterface
{
    /**
     * @param string $email
     * @param string $code
     * @return void
     */
    public function sendCodeEmail(string $email, string $code): void;
}
