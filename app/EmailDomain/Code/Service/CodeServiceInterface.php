<?php

namespace App\EmailDomain\Code\Service;

interface CodeServiceInterface
{
    /**
     * @param string $email
     * @return string
     */
    public function getCode(string $email): string;

    /**
     * @param string $email
     * @return string
     */
    public function generateCode(string $email): string;
}
