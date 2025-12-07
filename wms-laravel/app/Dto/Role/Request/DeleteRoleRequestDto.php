<?php

declare(strict_types=1);

namespace App\Dto\Role\Request;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Attributes\Validation\Required;

#[MapInputName(SnakeCaseMapper::class)]
class DeleteRoleRequestDto extends Data
{
    public function __construct(
        #[Required, Exists('roles', 'id')]
        public int $id
    ){}
}