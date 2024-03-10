<?php

namespace App\Http\Controllers\Admin\Catalog\Category;

use App\Http\Controllers\Controller;
use App\Models\Service\Catalog\CategoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReOrderController extends Controller
{
    public function __construct(
        private readonly CategoryService $categoryService
    ) {
    }


    public function __invoke(Request $request): RedirectResponse
    {
        $this->categoryService->reOrder($request['list']);

        return redirect()
            ->route('admin.catalog.category.create')
            ->with('success', 'Category re-ordered successfully');
    }
}
