<?php

namespace App\Http\Controllers\Role;

use Exception;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Services\Role\ReadRoleService;
use App\Services\Role\CreateRoleService;
use App\Services\Role\DeleteRoleService;
use App\Services\Role\UpdateRoleService;
use App\Dto\Role\Request\ReadRoleRequestDto;
use App\Dto\Role\Request\CreateRoleRequestDto;
use App\Dto\Role\Request\DeleteRoleRequestDto;
use App\Dto\Role\Request\UpdateRoleRequestDto;

class RoleController extends Controller
{
    public function __construct(
        private CreateRoleService $createRoleService,
        private DeleteRoleService $deleteRoleService,
        private UpdateRoleService $updateRoleService,
        private ReadRoleService $readRoleService
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

    public function read(): JsonResponse
    {
        try {
            $dto = ReadRoleRequestDto::from(request()->all());
            $response = $this->readRoleService->read($dto);
        
            return response()->json($response->toArray(), 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Role read failed',
                'error' => $e->getMessage()
            ], $e->getCode() ?: 500);
        }
    }

    public function update(): JsonResponse
    {
        try {
            $data = request()->all();
            $dto = UpdateRoleRequestDto::from($data);
            $response = $this->updateRoleService->update($dto);

            return response()->json($response->toArray(), 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Role update failed',
                'error' => $e->getMessage()
            ], $e->getCode() ?: 500);
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
