<?php

namespace App\Http\Controllers\Admin\Catalog\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Catalog\Category as CategoryRequest;
use App\Models\Service\Catalog\CategoryService;

class SaveController extends Controller
{
    /**
     * Class SaveController
     *
     * This controller is responsible for saving customer data.
     */
    public function __construct(
        private readonly CategoryService $categoryService
    ) {
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(CategoryRequest $request): RedirectResponse
    {
        try {
            $validated = $request->validated();
            $category = $this->categoryService->save($validated, $request->id);
        } catch (\Throwable $th) {
            return Redirect::back()->with('error', "Something went wrong. Please try again later.");
        }

        return redirect()
            ->route('admin.catalog.category.edit', ['id' => $category->id])
            ->with('success', 'Category created successfully');
    }
}
