<?php

namespace App\Http\Controllers;

use App\EmailDomain\Code\Service\CodeServiceInterface;
use App\EmailDomain\Email\MailerService\MailerServiceInterface;
use App\Http\Request\CodeRequest\CodeGenerateRequest;
use App\Http\Request\CodeRequest\CodeGetRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CodeController extends Controller
{
    /**
     * @param CodeServiceInterface $codeService
     * @param MailerServiceInterface $mailerService
     */
    public function __construct(
        private CodeServiceInterface $codeService,
        private MailerServiceInterface $mailerService,
    ) {
    }

    /**
     * @param CodeGenerateRequest $request
     * @return JsonResponse
     */
    public function generateCode(CodeGenerateRequest $request): JsonResponse
    {
        $code = $this->codeService->generateCode($email = $request->getEmail());

        $this->mailerService->sendCodeEmail($email, $code);

        return response()->json([
            'status' => Response::HTTP_OK,
        ], Response::HTTP_OK);
    }

    /**
     * @param CodeGetRequest $request
     * @return JsonResponse
     */
    public function getCode(CodeGetRequest $request): JsonResponse
    {
        return response()->json([
            'status' => Response::HTTP_OK,
            'data' => [
                'code' => $this->codeService->getCode($request->getEmail())
            ],
        ], Response::HTTP_OK);
    }
}
