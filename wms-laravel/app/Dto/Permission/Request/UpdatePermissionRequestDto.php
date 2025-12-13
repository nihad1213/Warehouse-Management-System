<?php

declare(strict_types=1);

namespace App\Dto\Permission\Request;

use Spatie\LaravelData\Attributes\Validation\IntegerType;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Unique;
use Spatie\LaravelData\Attributes\Validation\Required;

#[MapInputName(SnakeCaseMapper::class)] 
class UpdatePermissionRequestDto extends Data
{
    public function __construct(
        #[Required, IntegerType]
        public int $id,

        #[Max(255), Unique('permissions', 'name')]
        public string $name
    ){}
}