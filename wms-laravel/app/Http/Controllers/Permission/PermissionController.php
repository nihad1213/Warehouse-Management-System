<?php

declare(strict_types=1);

namespace App\Http\Controllers\Permission;

use App\Dto\Permission\Request\CreatePermissionRequestDto;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Services\Permission\CreatePermissionService;

class PermissionController extends Controller
{
    public function __construct(
        private CreatePermissionService $createPermissionService
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
}
