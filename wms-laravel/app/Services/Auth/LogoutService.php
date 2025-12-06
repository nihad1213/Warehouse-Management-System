<?php

declare(strict_types=1);

namespace App\Services\Auth;

use Illuminate\Support\Facades\Auth;
use App\Dto\Auth\Response\LogoutResponseDto;

class LogoutService
{
    public function logout(): LogoutResponseDto
    {
        Auth::guard('api')->logout();

        return LogoutResponseDto::success();
    }
}
