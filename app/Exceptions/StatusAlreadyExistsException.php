<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class StatusAlreadyExistsException extends Exception
{
    public function render(): JsonResponse
    {
        return response()->json([
            'message' => "Status already exists. Please, change status or Update existing comment.",
        ], Response::HTTP_FORBIDDEN);
    }
}
