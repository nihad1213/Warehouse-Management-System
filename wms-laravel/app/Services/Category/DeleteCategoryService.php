<?php

declare(strict_types=1);

namespace App\Services\Category;

use Exception;
use App\Models\Category;
use App\Exceptions\NotFoundException;
use App\Exceptions\OperationFailedException;
use App\Dto\Category\Request\DeleteCategoryRequestDto;
use App\Dto\Category\Response\DeleteCategoryResponseDto;

class DeleteCategoryService
{
    public function delete(DeleteCategoryRequestDto $dto): DeleteCategoryResponseDto
    {
        try {
            $category = Category::findOrFail($dto->id);
            $category->delete();
        
            return DeleteCategoryResponseDto::fromCategory($category); 
        } catch (Exception $e) {
            throw new OperationFailedException('Failed to delete category');
        }
    }
}