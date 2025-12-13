<?php

declare(strict_types=1);

namespace App\Services\Auth;

use App\Exceptions\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use App\Dto\Auth\Request\LoginRequestDto;
use App\Dto\Auth\Response\LoginResponseDto;

class LoginService
{
    public function login(LoginRequestDto $dto): LoginResponseDto
    {
        $credentials = [
            'email' => $dto->email,
            'password' => $dto->password,
        ];
        
        if (! $token = Auth::guard('api')->attempt($credentials)) {
            throw new AuthenticationException('Invalid email or password');
        }

        $user = Auth::guard('api')->user();

        return LoginResponseDto::fromUser($user,(string) $token);
    }
}