<?php

namespace App\Exceptions;

use Exception;

class Nip05NotFoundException extends Exception
{
    public function render($request)
    {
        return response()->json([
            'message' => 'The requested user was not found.'
        ], Response::HTTP_NOT_FOUND); // 404
    }
}
