<?php

declare(strict_types=1);

namespace App\Dto\Permission\Request;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\IntegerType;

class DeletePermissionRequestDto extends Data
{
    public function __construct(
        #[Required, IntegerType]
        public int $id
    ){}
}