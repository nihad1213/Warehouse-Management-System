<?php

declare(strict_types=1);

namespace App\Dto\Category\Request;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Unique;
use Spatie\LaravelData\Attributes\Validation\Required;

#[MapInputName(SnakeCaseMapper::class)]
class CreateCategoryRequestDto extends Data
{
    public function __construct(
        #[Required, Max(255), Unique('categories', 'name')]
        public string $name
    ){}
}
