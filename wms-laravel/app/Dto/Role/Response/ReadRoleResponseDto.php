<?php

declare(strict_types=1);

namespace App\Dto\Role\Response;

use App\Models\Role;
use Spatie\LaravelData\Data;
use Illuminate\Pagination\LengthAwarePaginator;

class ReadRoleResponseDto extends Data
{
    public function __construct(
        public ?int $id,
        public ?string $name,
        public ?array $roles,
        public ?array $pagination,
        public string $message,
    ){}

    public static function fromRoles(Role $role): self
    {
        return new self(
            id: $role->id,
            name: $role->name,
            roles: null,
            pagination: null,
            message: 'Role retrieved successfully',
        );
    }

    public static function fromPaginator(LengthAwarePaginator $paginator): self
    {
        return new self(
            id: null,
            name: null,
            roles: collect($paginator->items())->map(fn($roles) => [
                'id' => $roles->id,
                'name' => $roles->name,
            ])->toArray(),
            pagination: [
                'total' => $paginator->total(),
                'per_page' => $paginator->perPage(),
                'current_page' => $paginator->currentPage(),
                'last_page' => $paginator->lastPage(),
                'from' => $paginator->firstItem(),
                'to' => $paginator->lastItem(),
            ],
            message: 'Roles retrieved successfully',
        );
    }
}