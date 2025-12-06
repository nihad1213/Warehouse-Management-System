<?php

declare(strict_types=1);

namespace App\Services\Permission;

use App\Dto\Permission\Request\DeletePermissionRequestDto;
use App\Dto\Permission\Response\DeletePermissionResponseDto;
use App\Exceptions\CoreException;
use App\Models\Permission;
use Exception;

class DeletePermissionService
{
    public function delete(DeletePermissionRequestDto $dto): DeletePermissionResponseDto
    {
        try {
            $permission = Permission::find($dto->id);
            
            if (!$permission) {
                throw new CoreException('Permission not found', 404);
            }

            $permission->delete();

            return DeletePermissionResponseDto::fromPermission($permission);
        } catch (Exception $e) {
            throw new CoreException('Failed to delete permission', 202);
        }
    }
}
