<?php

declare(strict_types=1);
use App\Models\Category;
use App\Exceptions\NotFoundException;
use App\Exceptions\OperationFailedException;
use App\Dto\Category\Request\DeleteCategoryRequestDto;
use App\Dto\Permission\Response\DeleteCategoryResponseDto;

class DeleteCategoryService
{
    public function delete(DeleteCategoryRequestDto $dto): DeleteCategoryResponseDto
    {
        try {
            $category = Category::find($dto->id);

            if (!$category) {
                throw new NotFoundException('Category Not Found');
            }

            $category->delete();

            return DeleteCategoryResponseDto::fromCategory($category);
        } catch (Exception $e) {
            throw new OperationFailedException('Failed to delete category');
        }
    }
}