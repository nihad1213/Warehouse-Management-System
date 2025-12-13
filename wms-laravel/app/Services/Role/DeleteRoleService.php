<?php

declare(strict_types=1);

namespace App\Services\Role;

use App\Exceptions\OperationFailedException;
use Exception;
use App\Models\Role;
use App\Dto\Role\Request\DeleteRoleRequestDto;
use App\Dto\Role\Response\DeleteRoleResponseDto;

class DeleteRoleService
{
    public function delete(DeleteRoleRequestDto $dto): DeleteRoleResponseDto
    {
        try {
            $role = Role::findOrFail($dto->id);
            $role->permissions()->detach();
            $role->delete();

            return DeleteRoleResponseDto::fromRole($dto->id);
        } catch(Exception $e) {
            throw new OperationFailedException('Failed to delete role');
        }
        
    }   
}
