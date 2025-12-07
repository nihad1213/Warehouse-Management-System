<?php

namespace App\Http\Controllers\Role;

use Exception;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Services\Role\CreateRoleService;
use App\Services\Role\DeleteRoleService;
use App\Dto\Role\Request\CreateRoleRequestDto;
use App\Dto\Role\Request\DeleteRoleRequestDto;

class RoleController extends Controller
{
    public function __construct(
        private CreateRoleService $createRoleService,
        private DeleteRoleService $deleteRoleService
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

    public function delete(): JsonResponse
    {
        try {
            $data = request()->all();
            $dto = DeleteRoleRequestDto::from($data);
            $response = $this->deleteRoleService->delete($dto);

            return response()->json($response->toArray(), 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error deleting role',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
