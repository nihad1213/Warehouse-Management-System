<?php

declare(strict_types=1);

namespace App\Services\Permission;

use Exception;
use App\Models\Permission;
use App\Exceptions\CoreException;
use Illuminate\Support\Facades\DB;
use App\Dto\Permission\Request\CreatePermissionRequestDto;
use App\Dto\Permission\Response\CreatePermissionResponseDto;

class CreatePermissionService
{
    public function create(CreatePermissionRequestDto $dto): CreatePermissionResponseDto
    {
        try {
            $permission = DB::transaction(function () use ($dto) {
                return Permission::create([
                    'name' => $dto->name,
                ]);
            });

            return CreatePermissionResponseDto::fromPermission($permission);
        } catch (Exception $e) {
            throw new CoreException('Failed to create permission', 500);
        }
    }
}
