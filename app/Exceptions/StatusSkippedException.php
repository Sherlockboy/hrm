<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class StatusSkippedException extends Exception
{
    public function render(): JsonResponse
    {
        return response()->json([
            'message' => "Unable to assign status, previous status is skipped.",
        ], Response::HTTP_METHOD_NOT_ALLOWED);
    }
}
