<?php

namespace App\EmailDomain\Code\Exception;

use Exception;

class CodeNotFoundException extends Exception
{
    protected $message = "Code not found.";
}
