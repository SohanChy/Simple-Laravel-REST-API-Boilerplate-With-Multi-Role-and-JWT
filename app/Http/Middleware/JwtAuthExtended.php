<?php

namespace App\Http\Middleware;

use App\JsonReturn;
use Tymon\JWTAuth\Middleware\GetUserFromToken;

class JwtAuthExtended extends GetUserFromToken
{
    protected function respond($event, $error, $status, $payload = [])
    {
        $response = $this->events->fire($event, $payload, true);

        return $response ?: JsonReturn::error($error, $status);
    }
}
