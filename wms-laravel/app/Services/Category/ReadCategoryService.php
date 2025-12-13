<?php

declare(strict_types=1);

namespace App\Services\Category;

use App\Dto\Category\Request\ReadCategoryRequestDto;
use App\Dto\Category\Response\ReadCategoryResponseDto;
use App\Models\Category;
use App\Models\Permission;
use App\Dto\Permission\Request\ReadPermissionRequestDto;
use App\Dto\Permission\Response\ReadPermissionResponseDto;

class ReadCategoryService
{

    public function read(ReadCategoryRequestDto $dto): ReadCategoryResponseDto
    {
        if ($dto->id !== null) {
            $category = Category::findOrFail($dto->id);
            return ReadCategoryResponseDto::fromCategory($category);
        }

        $categories = Category::paginate($dto->perPage, ['*'], 'page', $dto->page);
        return ReadCategoryResponseDto::fromPaginator($categories);
    }
}