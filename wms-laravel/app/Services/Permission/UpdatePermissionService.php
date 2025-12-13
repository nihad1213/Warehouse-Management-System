<?php

declare(strict_types=1);

namespace App\Services\Permission;

use App\Exceptions\NotFoundException;
use App\Exceptions\OperationFailedException;
use Exception;
use App\Models\Permission;
use App\Dto\Permission\Request\UpdatePermissionRequestDto;
use App\Dto\Permission\Response\UpdatePermissionResponseDto;

class UpdatePermissionService
{
    public function update(UpdatePermissionRequestDto $dto): UpdatePermissionResponseDto
    {
        $permission = Permission::find($dto->id);

        if (!$permission) {
            throw new NotFoundException('Permission not found');
        }

        try {
            $permission->name = $dto->name;
            $permission->save();

            return UpdatePermissionResponseDto::fromPermission($permission);

        } catch (Exception $e) {
            throw new OperationFailedException('Failed to update permission');
        }
    }
}
