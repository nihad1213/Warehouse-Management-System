<?php


declare(strict_types=1);

namespace App\Dto\Role\Response;

use App\Models\Role;
use Spatie\LaravelData\Data;

class CreateRoleResponseDto extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        public array $permissions,
        public string $message
    ){}

    public static function fromRole(Role $role): self
    {
        return new self(
            id: $role->id,
            name: $role->name,
            permissions: $role->permissions->pluck('name')->toArray(),
            message: 'Permission created successfully',
        );
    }


}