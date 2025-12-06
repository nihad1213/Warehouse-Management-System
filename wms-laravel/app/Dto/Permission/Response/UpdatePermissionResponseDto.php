<?php

declare(strict_types=1);

namespace App\Dto\Permission\Response;

use App\Models\Permission;
use Spatie\LaravelData\Data;

class UpdatePermissionResponseDto extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        public string $message,
    ){}

    public static function fromPermission(Permission $permission): self
    {
        return new self(
            id: $permission->id,
            name: $permission->name,
            message: 'Permission updated successfully',
        );
    }
}