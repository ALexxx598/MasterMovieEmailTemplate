<?php

namespace App\Common;

use Spatie\Enum\Enum;

/**
 * @method static self CODE_NOT_FOUND()
 * @method static self NOV_VALID_REQUEST()
 */
class ErrorCodes extends Enum
{
    protected const NOV_VALID_REQUEST = '2001';
    protected const CODE_NOT_FOUND = '2010';

    protected static function labels(): array
    {
        return [
            'NOV_VALID_REQUEST' => '2001',
            'CODE_NOT_FOUND' => '2010',
        ];
    }
}
