<?php

declare(strict_types=1);

namespace App\Dto\Category\Request;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\IntegerType;

class DeleteCategoryRequestDto extends Data
{
    public function __construct(
        #[Required, IntegerType]
        public int $id
    ){}
}