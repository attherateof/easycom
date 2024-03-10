<?php

namespace App\Models\Service\Catalog;

use App\Models\Catalog\Category;
use App\Models\Service\Image as ImageService;
use Throwable;

class CategoryService
{
    /**
     * @param ImageService $imageService
     */
    public function __construct(
        private readonly ImageService $imageService
    ) {
    }

    /**
     * @param array $categoryData
     * @param int|null $categoryId
     * @return Category
     * @throws Throwable
     */
    public function save(array $categoryData, ?int $categoryId = null): Category
    {
        $category =  ($categoryId) ? Category::findOrFail($categoryId) : new Category();
//        dd($category->toArray());
        $categoryData = $this->handleImages($categoryData, $category);
        $category->fill($categoryData);
        $category->save();

        return  $category;
    }

    private function handleImages(array $categoryData, ?Category $category): array
    {
        foreach (['banner', 'meta_image'] as $imageField) {
            if (isset($categoryData[$imageField])) {
                if ($category && $category->$imageField) {
                    $this->imageService->delete($category->$imageField);
                }
                $categoryData[$imageField] = $this->saveImage($categoryData[$imageField]);
            } elseif ($category && $category->$imageField) {
                $categoryData[$imageField] = $category->$imageField;
            }
        }

        return $categoryData;
    }


    private function saveImage(string $imageString): string
    {
        return $this->imageService->setImageString($imageString)->save();
    }
}
