<?php

declare(strict_types=1);

namespace App\Services\Permission;

use App\Dto\Permission\Request\DeletePermissionRequestDto;
use App\Dto\Permission\Response\DeletePermissionResponseDto;
use App\Exceptions\NotFoundException;
use App\Exceptions\OperationFailedException;
use App\Models\Permission;
use Exception;

class DeletePermissionService
{
    public function delete(DeletePermissionRequestDto $dto): DeletePermissionResponseDto
    {
        try {
            $permission = Permission::find($dto->id);
            
            if (!$permission) {
                throw new NotFoundException('Permission not found');
            }

            $permission->delete();

            return DeletePermissionResponseDto::fromPermission($permission);
        } catch (Exception $e) {
            throw new OperationFailedException('Failed to delete permission');
        }
    }
}
