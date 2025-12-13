<?php

declare(strict_types=1);

namespace App\Dto\Permission\Response;

use App\Models\Category;
use Spatie\LaravelData\Data;

class UpdateCategoryResponseDto extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        public string $message,
    ){}

    public static function fromCategory(Category $category): self
    {
        return new self(
            id: $category->id,
            name: $category->name,
            message: 'Category updated successfully',
        );
    }
}