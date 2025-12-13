<?php

declare(strict_types=1);
use App\Models\Category;
use App\Exceptions\OperationFailedException;
use App\Dto\Category\Request\CreateCategoryRequestDto;
use App\Dto\Category\Response\CreateCategoryResponseDto;

class CreateCategoryService
{
    public function create(CreateCategoryRequestDto $dto): CreateCategoryResponseDto
    {
        try {
            $category = Category::create([
                'name' => $dto->name,
            ]);

            return CreateCategoryResponseDto::fromPermission($category);
        } catch (Exception $e) {
            throw new OperationFailedException('Failed to create category');
        }
    }
}