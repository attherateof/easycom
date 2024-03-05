<?php

namespace App\Models\Service\Catalog;

use App\Models\Catalog\Category;
use Illuminate\Support\Facades\Log;
use Throwable;
class CategoryService
{
    /**
     * @throws Throwable
     */
    public function save(array $userData, ?int $categoryId = null): Category
    {
        try {
            if (!$categoryId) {
                return Category::create($userData);
            } else {
                $category = Category::findOrFail($categoryId);
                $category->update($userData);
                return $category;
            }
        } catch (Throwable $th) {
            Log::error($th->getMessage(), [
                "context" => "[Category][Save]",
                "trace" => $th->getTraceAsString(),
            ]);
            throw $th;
        }
    }
}
