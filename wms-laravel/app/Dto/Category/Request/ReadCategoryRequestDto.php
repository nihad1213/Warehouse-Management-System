<?php

declare(strict_types=1);

namespace App\Dto\Category\Request;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Attributes\Validation\Numeric;

#[MapInputName(SnakeCaseMapper::class)] 
class ReadCategoryRequestDto extends Data
{
    public function __construct(
        #[Numeric, Exists('categories', 'id')]
        public ?int $id = null,
        
        #[Numeric, Min(1)]
        public int $perPage = 15,
        
        #[Numeric, Min(1)]
        public int $page = 1,
    ){}
}