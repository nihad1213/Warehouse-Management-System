<?php

declare(strict_types=1);

namespace App\Services\Category;

use Exception;
use App\Models\Category;
use App\Exceptions\NotFoundException;
use App\Exceptions\OperationFailedException;
use App\Dto\Category\Request\UpdateCategoryRequestDto;
use App\Dto\Category\Response\UpdateCategoryResponseDto;

class UpdateCategoryService
{
    public function update(UpdateCategoryRequestDto $dto): UpdateCategoryResponseDto
    {
        $category = Category::find($dto->id);

        if (!$category) {
            throw new NotFoundException('Category not found');
        }

        try {
            $category->name = $dto->name;
            $category->save();

            return UpdateCategoryResponseDto::fromCategory($category);

        } catch (Exception $e) {
            throw new OperationFailedException('Failed to update category');
        }
    }
}
