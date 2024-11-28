<?php

namespace App\EmailDomain\Code\Service;

use App\EmailDomain\Code\Exception\CodeNotFoundException;
use Illuminate\Support\Facades\Cache;

class CodeService implements CodeServiceInterface
{
    /**
     * @param string $email
     * @return string
     * @throws CodeNotFoundException
     */
    public function getCode(string $email): string
    {
        $code = Cache::get($email);

        if ($code === null) {
            throw new CodeNotFoundException();
        }

        return $code;
    }

    /**
     * @param string $email
     * @return string
     * @throws \Exception
     */
    public function generateCode(string $email): string
    {
        Cache::put($email, $code = bin2hex(random_bytes(4)), 180);

        return $code;
    }
}
