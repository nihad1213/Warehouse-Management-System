<?php

declare(strict_types=1);

namespace App\Dto\Permission\Response;

use App\Models\Permission;
use Spatie\LaravelData\Data;
use Illuminate\Pagination\LengthAwarePaginator;

class ReadPermissionResponseDto extends Data
{
    public function __construct(
        public ?int $id,
        public ?string $name,
        public ?array $permissions,
        public ?array $pagination,
        public string $message,
    ){}

    public static function fromPermission(Permission $permission): self
    {
        return new self(
            id: $permission->id,
            name: $permission->name,
            permissions: null,
            pagination: null,
            message: 'Permission retrieved successfully',
        );
    }

    public static function fromPaginator(LengthAwarePaginator $paginator): self
    {
        return new self(
            id: null,
            name: null,
            permissions: collect($paginator->items())->map(fn($permission) => [
                'id' => $permission->id,
                'name' => $permission->name,
            ])->toArray(),
            pagination: [
                'total' => $paginator->total(),
                'per_page' => $paginator->perPage(),
                'current_page' => $paginator->currentPage(),
                'last_page' => $paginator->lastPage(),
                'from' => $paginator->firstItem(),
                'to' => $paginator->lastItem(),
            ],
            message: 'Permissions retrieved successfully',
        );
    }
}