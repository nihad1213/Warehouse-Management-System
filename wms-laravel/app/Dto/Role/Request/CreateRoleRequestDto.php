<?php

declare(strict_types=1);

namespace App\Dto\Role\Request;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\ArrayType;

#[MapInputName(SnakeCaseMapper::class)] 
class CreateRoleRequestDto extends Data
{
    public function __construct(
        #[Required, Min(3), Max(255)]
        public string $name,
        
        #[MapInputName('permission_ids')]
        #[Required, ArrayType]
        public array $permissionIDs
    ){}
}