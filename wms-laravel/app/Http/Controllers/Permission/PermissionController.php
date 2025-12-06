<?php

declare(strict_types=1);

namespace App\Http\Controllers\Permission;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Services\Permission\CreatePermissionService;
use App\Services\Permission\DeletePermissionService;
use App\Services\Permission\UpdatePermissionService;
use App\Dto\Permission\Request\CreatePermissionRequestDto;
use App\Dto\Permission\Request\DeletePermissionRequestDto;
use App\Dto\Permission\Request\UpdatePermissionRequestDto;

class PermissionController extends Controller
{
    public function __construct(
        private CreatePermissionService $createPermissionService,
        private UpdatePermissionService $updatePermissionService,
        private DeletePermissionService $deletePermissionService
    ){}

    public function create(): JsonResponse
    {
        try {
            $dto = CreatePermissionRequestDto::from(request()->all());
            $response = $this->createPermissionService->create($dto);

            return response()->json($response->toArray(), 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Permission creation failed',
                'error' => $e->getMessage()
            ], $e->getCode() ?: 500);
        }
    }

    public function update(): JsonResponse
    {
        try {
            $data = request()->all();
            $dto = UpdatePermissionRequestDto::from($data);
            $response = $this->updatePermissionService->update($dto);

            return response()->json($response->toArray(), 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Permission update failed',
                'error' => $e->getMessage()
            ], $e->getCode() ?: 500);
        }
    }

    public function delete(): JsonResponse
    {
        try {
            $data = request()->all();
            $dto = DeletePermissionRequestDto::from($data);
            $response = $this->deletePermissionService->delete($dto);

            return response()->json($response->toArray(), 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Permission delete failed',
                'error' => $e->getMessage()
            ], $e->getCode() ?: 500);
        }
    }
}
