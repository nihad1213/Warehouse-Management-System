<?php

declare(strict_types=1);

namespace App\Services\Role;

use App\Exceptions\NotFoundException;
use App\Exceptions\OperationFailedException;
use Exception;
use App\Models\Role;
use App\Models\Permission;
use App\Dto\Role\Request\CreateRoleRequestDto;
use App\Dto\Role\Response\CreateRoleResponseDto;

class CreateRoleService
{
    public function create(CreateRoleRequestDto $dto): CreateRoleResponseDto
    {
        try {

            $existingPermissions = Permission::whereIn('id', $dto->permissionIDs)->pluck('id')->toArray();
            
            if (count($existingPermissions) !== count($dto->permissionIDs)) {
                throw new NotFoundException('One or more permissions do not exist');
            }


            $role = Role::create([
                'name' => $dto->name,
            ]);
        
            $role->permissions()->attach($dto->permissionIDs);
            return CreateRoleResponseDto::fromRole($role->load('permissions'));
        } catch (Exception $e) {
            throw new OperationFailedException('Failed to create role');
        }
    }
}
