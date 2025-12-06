<?php

declare(strict_types=1);

namespace App\Services\Permission;

use App\Models\Permission;
use App\Dto\Permission\Request\ReadPermissionRequestDto;
use App\Dto\Permission\Response\ReadPermissionResponseDto;

class ReadPermissionService
{

    public function read(ReadPermissionRequestDto $dto): ReadPermissionResponseDto
    {
        if ($dto->id !== null) {
            $permission = Permission::findOrFail($dto->id);
            return ReadPermissionResponseDto::fromPermission($permission);
        }

        $permissions = Permission::paginate($dto->perPage, ['*'], 'page', $dto->page);
        return ReadPermissionResponseDto::fromPaginator($permissions);
    }
}