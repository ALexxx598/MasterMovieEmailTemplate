<?php

namespace App\Http\Request\CodeRequest;

use App\Common\EmailMicroserviceRequest;

class CodeGenerateRequest extends EmailMicroserviceRequest
{
    /**
     * @inheritDoc
     */
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
