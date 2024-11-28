<?php

namespace App\Exceptions;

use App\Common\CanNotDeleteException;
use App\Common\ErrorCodes;
use App\Common\NotFoundException;
use App\EmailDomain\Code\Exception\CodeNotFoundException;
use App\MovieDomain\User\Exception\NonValidPasswordException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * @param \Illuminate\Http\Request $request
     * @param Throwable $e
     * @return JsonResponse
     */
    public function render($request, Throwable $e): JsonResponse
    {
        return match (true) {
            $e instanceof CodeNotFoundException => $this->mapCodeNotFoundException($e),
            $e instanceof ValidationException => $this->mapValidationException($e),
            default => $this->mapExceptionByDefault($e)
        };
    }

    /**
     * @param Throwable $e
     * @return JsonResponse
     */
    private function mapExceptionByDefault(Throwable $e): JsonResponse
    {
        return response()->json(
            [
                'message' => $e->getMessage(),
                'error_code' => $e->getCode(),
            ],
            Response::HTTP_INTERNAL_SERVER_ERROR
        );
    }

    /**
     * @param CodeNotFoundException $e
     * @return JsonResponse
     */
    private function mapCodeNotFoundException(CodeNotFoundException $e): JsonResponse
    {
        return response()->json(
            [
                'message' => $e->getMessage(),
                'error' => ErrorCodes::CODE_NOT_FOUND()->value,
                'error_code' => ErrorCodes::CODE_NOT_FOUND()->label,
            ],
            Response::HTTP_BAD_REQUEST
        );
    }

    /**
     * @param ValidationException $e
     * @return JsonResponse
     */
    private function mapValidationException(ValidationException $e): JsonResponse
    {
        return response()->json(
            [
                'message' => $e->getMessage(),
                'error' => ErrorCodes::NOV_VALID_REQUEST()->value,
                'error_code' => ErrorCodes::NOV_VALID_REQUEST()->label,
            ],
            Response::HTTP_BAD_REQUEST
        );
    }
}
