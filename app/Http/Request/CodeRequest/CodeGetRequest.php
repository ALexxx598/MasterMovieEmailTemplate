<?php

namespace App\Http\Request\CodeRequest;

use App\Common\EmailMicroserviceRequest;

class CodeGetRequest extends EmailMicroserviceRequest
{
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email',
            ],
        ];
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->input('email');
    }
}
