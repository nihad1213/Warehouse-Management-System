<?php

declare(strict_types=1);

namespace App\Dto\Auth\Response;

use App\Models\User;
use Spatie\LaravelData\Data;

class LoginResponseDto extends Data
{
    public function __construct(
        public int $id,
        public string $token,
        public string $message,
    ){}

    public static function fromUser(User $user, string $token): self
    {
        return new self(
            id: $user->id,
            token: $token,
            message: 'User logined successfully',
        );
    }
}