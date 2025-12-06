<?php

declare(strict_types=1);

namespace App\Dto\Auth\Request;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\Validation\Same;
use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\Required;

#[MapInputName(SnakeCaseMapper::class)] 
class LoginRequestDto extends Data
{
    public function __construct(
        #[Required, Email]
        public string $email,

        #[Required]
        public string $password,
    ){}
}