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

    /**
     * @param int $categoryId
     * @return void
     */
    public function delete(int $categoryId): void
    {
        $category =  ($categoryId) ? Category::findOrFail($categoryId) : null;
        if ($category) {
            $this->deleteImages($category);
            Category::destroy($categoryId);
        }
    }

    public function reOrder(array $list): void
    {
        if ($list) {
            foreach ($list as $key => $item) {
                $category =  ($item['id']) ? Category::findOrFail($item['id']) : null;
                if ($category) {
                    $category->parent_id = $item['parent_id'];
                    $category->sort_order = $key + 1;
                    $category->save();
                }
            }
        }
    }

    /**
     * @param Category $category
     * @return void
     */
    private function deleteImages(Category $category): void
    {
        foreach (self::IMAGE_FIELDS as $imageField) {
            if (isset($category->$imageField)) {
                $this->imageService->delete($category->$imageField);
            }
        }
    }

    /**
     * @param array $categoryData
     * @param Category|null $category
     * @return array
     */
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

    /**
     * @param string $imageString
     * @return string
     */
    private function saveImage(string $imageString): string
    {
        return $this->imageService->setImageString($imageString)->save();
    }
}
