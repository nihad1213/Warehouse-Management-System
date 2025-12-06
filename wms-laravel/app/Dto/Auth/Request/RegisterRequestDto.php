<?php

declare(strict_types=1);

namespace App\Dto\Auth\Request;

use Spatie\LaravelData\Attributes\Validation\IntegerType;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Same;
use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\Regex;
use Spatie\LaravelData\Attributes\Validation\Unique;
use Spatie\LaravelData\Attributes\Validation\Required;

#[MapInputName(SnakeCaseMapper::class)] 
class RegisterRequestDto extends Data
{
    public function __construct(
        #[Required, Min(5)]
        public string $firstName,
        
        #[Required, Min(5)]
        public string $lastName,
        
        #[Min(5)]
        public ?string $middleName,

        #[Required, IntegerType]
        public int $roleId,

        #[Required, Email, Unique('users', 'email')]
        public string $email,

        #[Required, Min(8)]
        public string $password,
        
        #[Required, Same('password')]
        public string $passwordAgain,

        #[Regex(pattern: '/^\+?[1-9]\d{1,14}$/'), Unique('users', 'phone_number')]
        public ?string $phoneNumber = null, 
    ){}

    public function getFullName(): string
    {
        $parts = array_filter([
            $this->firstName,
            $this->middleName,
            $this->lastName,
        ]);

        return implode(' ', $parts);
    }
}