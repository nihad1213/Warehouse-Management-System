<?php

declare(strict_types=1);

namespace App\Services\Permission;

use Exception;
use App\Exceptions\OperationFailedException;
use App\Models\Permission;
use App\Dto\Permission\Request\CreatePermissionRequestDto;
use App\Dto\Permission\Response\CreatePermissionResponseDto;

class CreatePermissionService
{
    public function create(CreatePermissionRequestDto $dto): CreatePermissionResponseDto
    {
        try {
            $permission = Permission::create([
                'name' => $dto->name,
            ]);

            return CreatePermissionResponseDto::fromPermission($permission);
        } catch (Exception $e) {
            throw new OperationFailedException('Failed to create permission');
        }
    }
}
