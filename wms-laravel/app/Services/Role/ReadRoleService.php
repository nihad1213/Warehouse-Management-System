<?php

declare(strict_types=1);

namespace App\Services\Role;

use App\Dto\Role\Request\ReadRoleRequestDto;
use App\Dto\Role\Response\ReadRoleResponseDto;
use App\Models\Role;



class ReadRoleService
{

    public function read(ReadRoleRequestDto $dto): ReadRoleResponseDto
    {
        if ($dto->id !== null) {
            $role = Role::findOrFail($dto->id);
            return ReadRoleResponseDto::fromRoles($role);
        }

        $roles = Role::paginate($dto->perPage, ['*'], 'page', $dto->page);
        return ReadRoleResponseDto::fromPaginator($roles);
    }
}