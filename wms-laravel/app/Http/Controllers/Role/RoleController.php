<?php

namespace App\Http\Controllers\Role;

use App\Dto\Role\Request\CreateRoleRequestDto;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Services\Role\CreateRoleService;

class RoleController extends Controller
{
    public function __construct(
        private CreateRoleService $createRoleService
    ){}

    public function create(): JsonResponse
    {
        try {
            $dto = CreateRoleRequestDto::from(request()->all());
            $response = $this->createRoleService->create($dto);

            return response()->json($response, 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error creating role',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
