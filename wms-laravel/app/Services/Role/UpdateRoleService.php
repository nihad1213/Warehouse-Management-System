<?php

declare(strict_types=1);

namespace App\Services\Role;

use App\Exceptions\NotFoundException;
use App\Exceptions\OperationFailedException;
use Exception;
use App\Models\Role;
use App\Models\Permission;
use App\Exceptions\CoreException;
use Illuminate\Support\Facades\DB;
use App\Dto\Role\Request\UpdateRoleRequestDto;
use App\Dto\Role\Response\UpdateRoleResponseDto;

class UpdateRoleService
{
    public function update(UpdateRoleRequestDto $dto): UpdateRoleResponseDto
    {
        try {
            $existingPermissions = Permission::whereIn('id', $dto->permissionIDs)->pluck('id')->toArray();
            
            if (count($existingPermissions) !== count($dto->permissionIDs)) {
                throw new NotFoundException('One or more permissions do not exist');
            }

            $role = Role::findOrFail($dto->id);
            
            $role->update([
                'name' => $dto->name,
            ]);

            $role->permissions()->sync($dto->permissionIDs);

            return UpdateRoleResponseDto::fromRole($role->load('permissions'));
        } catch (Exception $e) {
            throw new OperationFailedException('Failed to update role');
        }
    }
}