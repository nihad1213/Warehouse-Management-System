<?php

declare(strict_types=1);

namespace App\Dto\Category\Response;

use App\Models\Category;
use App\Models\Permission;
use Spatie\LaravelData\Data;
use Illuminate\Pagination\LengthAwarePaginator;

class ReadCategoryResponseDto extends Data
{
    public function __construct(
        public ?int $id,
        public ?string $name,
        public ?array $categories,
        public ?array $pagination,
        public string $message,
    ){}

    public static function fromCategory(Category $category): self
    {
        return new self(
            id: $category->id,
            name: $category->name,
            categories: null,
            pagination: null,
            message: 'Categories retrieved successfully',
        );
    }

    public static function fromPaginator(LengthAwarePaginator $paginator): self
    {
        return new self(
            id: null,
            name: null,
            categories: collect($paginator->items())->map(fn($category) => [
                'id' => $category->id,
                'name' => $category->name,
            ])->toArray(),
            pagination: [
                'total' => $paginator->total(),
                'per_page' => $paginator->perPage(),
                'current_page' => $paginator->currentPage(),
                'last_page' => $paginator->lastPage(),
                'from' => $paginator->firstItem(),
                'to' => $paginator->lastItem(),
            ],
            message: 'Categories retrieved successfully',
        );
    }
}