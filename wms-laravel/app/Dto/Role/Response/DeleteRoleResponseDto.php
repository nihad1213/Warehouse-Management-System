<?php

declare(strict_types=1);

namespace App\Dto\Role\Response;

use Spatie\LaravelData\Data;

class DeleteRoleResponseDto extends Data
{
    public function __construct(
        public int $id,
        public string $message
    ){}

    public static function fromRole(int $id): self
    {
        return new self(
            id: $id,
            message: 'Role deleted successfully'
        );
    }
}