<?php

declare(strict_types=1);

namespace App\Dto\Auth\Response;

use Spatie\LaravelData\Data;

class LogoutResponseDto extends Data
{
    public function __construct(
        public string $message
    ){}

    public static function success(): self
    {
        return new self(message: 'Logout successful');
    }
}