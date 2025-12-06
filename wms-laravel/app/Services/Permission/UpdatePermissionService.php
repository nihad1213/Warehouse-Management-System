<?php

declare(strict_types=1);

namespace App\Services\Permission;

use Exception;
use App\Models\Permission;
use App\Exceptions\CoreException;
use Illuminate\Support\Facades\DB;
use App\Dto\Permission\Request\UpdatePermissionRequestDto;
use App\Dto\Permission\Response\UpdatePermissionResponseDto;

class UpdatePermissionService
{
    public function update(UpdatePermissionRequestDto $dto): UpdatePermissionResponseDto
    {
        $permission = Permission::find($dto->id);

        if (!$permission) {
            throw new CoreException('Permission not found', 404);
        }

        try {
            $permission->name = $dto->name;
            $permission->save();

            return UpdatePermissionResponseDto::fromPermission($permission);

        } catch (Exception $e) {
            throw new CoreException('Failed to update permission', 500);
        }
    }
}
