<?php

declare(strict_types=1);

namespace App\Services\Auth;

use App\Models\Role;
use App\Models\User;
use App\Exceptions\CoreException;
use Illuminate\Support\Facades\Hash;
use App\Dto\Auth\Request\RegisterRequestDto;
use App\Dto\Auth\Response\RegisterResponseDto;
use Tymon\JWTAuth\Facades\JWTAuth;

class RegisterService
{
    public function regsister(RegisterRequestDto $dto): RegisterResponseDto
    {
        $defaultRole = Role::where('name', 'admin')->first();

        if (!$defaultRole) {
            throw new CoreException('Default role not found', 404);
        }

        $user = User::create([
            'name' => $dto->getFullName(),
            'email' => $dto->email,
            'password' => Hash::make($dto->password),
            'phone_number' => $dto->phoneNumber,
            'role_id' => $defaultRole->id,
        ]);

        $token = JWTAuth::fromUser($user);

        return RegisterResponseDto::fromUser($user, $token);
    }
}
