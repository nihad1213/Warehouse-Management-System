<?php

declare(strict_types=1);

namespace App\Services\Auth;

use App\Exceptions\NotFoundException;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Dto\Auth\Request\RegisterRequestDto;
use App\Dto\Auth\Response\RegisterResponseDto;
use Tymon\JWTAuth\Facades\JWTAuth;

class RegisterService
{
    public function regsister(RegisterRequestDto $dto): RegisterResponseDto
    {
        $role = Role::find($dto->roleId);

        if (!$role) {
            throw new NotFoundException('Selected role not Found!');
        }

        $user = User::create([
            'name' => $dto->getFullName(),
            'email' => $dto->email,
            'password' => Hash::make($dto->password),
            'phone_number' => $dto->phoneNumber,
            'role_id' => $role->id,
        ]);

        $token = JWTAuth::fromUser($user);

        return RegisterResponseDto::fromUser($user, $token);
    }
}
