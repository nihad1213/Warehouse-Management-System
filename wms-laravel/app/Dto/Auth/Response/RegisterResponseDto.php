<?php

declare(strict_types=1);

namespace App\Dto\Auth\Response;

use App\Models\User;
use Spatie\LaravelData\Data;

class RegisterResponseDto extends Data
{
   public function __construct(
        public int $id,
        public string $name,
        public string $email,
        public string $phone_number,
        public string $role,
        public string $token,
        public string $message,
    ) {}
    
    public static function fromUser(User $user, string $token): self
    {
        return new self(
            id: $user->id,
            name: $user->name,
            email: $user->email,
            phone_number: $user->phone_number,
            role: $user->role->name,
            token: $token,
            message: 'User registered successfully',
        );
    }
}