<?php

namespace App\Models\Service\Catalog;

use App\Models\Catalog\Category;
use App\Models\Service\Image as ImageService;
use Throwable;

class CategoryService
{
    private const IMAGE_FIELDS = ['banner', 'meta_image'];

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
        $categoryData = $this->handleImages($categoryData, $category);
        $category->fill($categoryData);
        $category->save();

        return  $category;
    }

    public function delete(int $categoryId): void
    {
        $category =  ($categoryId) ? Category::findOrFail($categoryId) : null;
        if ($category) {
            $this->deleteImages($category);
            Category::destroy($categoryId);
        }
    }

    private function deleteImages(Category $category): void
    {
        foreach (self::IMAGE_FIELDS as $imageField) {
            if (isset($category->$imageField)) {
                $this->imageService->delete($category->$imageField);
            }
        }
    }

    private function handleImages(array $categoryData, ?Category $category): array
    {
        foreach (self::IMAGE_FIELDS as $imageField) {
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
