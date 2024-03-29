<?php

namespace App\Http\Controllers\Admin\Catalog\Category;

use App\Http\Controllers\Controller;
use App\Models\Service\Catalog\CategoryService;
use Illuminate\Http\RedirectResponse;

class DeleteController extends Controller
{
    public function __construct(
        private readonly CategoryService $categoryService
    ) {
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function __invoke(int $id): RedirectResponse
    {
        $this->categoryService->delete($id);

        return redirect()
            ->route('admin.catalog.category.create')
            ->with('success', 'Category deleted successfully');
    }
}
