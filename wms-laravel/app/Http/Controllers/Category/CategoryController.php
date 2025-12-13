<?php

declare(strict_types=1);

namespace App\Http\Controllers\Category;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Services\Category\ReadCategoryService;
use App\Services\Category\CreateCategoryService;
use App\Services\Category\DeleteCategoryService;
use App\Services\Category\UpdateCategoryService;
use App\Dto\Category\Request\ReadCategoryRequestDto;
use App\Dto\Category\Request\CreateCategoryRequestDto;
use App\Dto\Category\Request\DeleteCategoryRequestDto;
use App\Dto\Category\Request\UpdateCategoryRequestDto;

class CategoryController extends Controller
{
    public function __construct(
        private CreateCategoryService $createCategoryService,
        private UpdateCategoryService $updateCategoryService,
        private DeleteCategoryService $deleteCategoryService,
        private ReadCategoryService $readCategoryService
    ){}

    public function create(): JsonResponse
    {
        try {
            $dto = CreateCategoryRequestDto::from(request()->all());
            $response = $this->createCategoryService->create($dto);

            return response()->json($response->toArray(), 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Category creation failed',
                'error' => $e->getMessage()
            ], $e->getCode() ?: 500);
        }
    }

    public function update(): JsonResponse
    {
        try {
            $data = request()->all();
            $dto = UpdateCategoryRequestDto::from($data);
            $response = $this->updateCategoryService->update($dto);

            return response()->json($response->toArray(), 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Category update failed',
                'error' => $e->getMessage()
            ], $e->getCode() ?: 500);
        }
    }

    public function delete(): JsonResponse
    {
        try {
            $data = request()->all();
            $dto = DeleteCategoryRequestDto::from($data);
            $response = $this->deleteCategoryService->delete($dto);

            return response()->json($response->toArray(), 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Category delete failed',
                'error' => $e->getMessage()
            ], $e->getCode() ?: 500);
        }
    }

    public function read(): JsonResponse
    {
        try {
            $dto = ReadCategoryRequestDto::from(request()->all());
            $response = $this->readCategoryService->read($dto);

            return response()->json($response->toArray(), 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Category read failed',
                'error' => $e->getMessage()
            ], $e->getCode() ?: 500);
        }
    }
}
