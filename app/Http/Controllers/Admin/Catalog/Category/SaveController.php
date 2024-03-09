<?php

namespace App\Http\Controllers\Admin\Catalog\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Catalog\Category as CategoryRequest;
use App\Models\Service\Image as ImageService;
use App\Models\Service\Catalog\CategoryService;

class SaveController extends Controller
{
    /**
     * Class SaveController
     *
     * This controller is responsible for saving customer data.
     */
    public function __construct(
        private readonly CategoryService $categoryService,
        private readonly ImageService $imageService
    ) {
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(CategoryRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $userData = [
            "status" => $validated['status'],
            "title" => $validated['title'],
            "display_type" => $validated['display_type'],
            "slug" => $validated['slug'],
            "description" => $validated['description'],
            "meta_title" => $validated['meta_title'],
            "meta_description" => $validated['meta_description'],
            "parent_id" => (isset($validated['parent_id'])) ? $validated['parent_id'] : 0,
            "sort_order" => (isset($validated['sort_order'])) ? $validated['sort_order'] : 0,
        ];

        if ($validated['banner']) {
            $userData['banner'] = $this->imageService->setImageString($validated['banner'])->save();
        }

        if ($validated['meta_image']) {
            $userData['meta_image'] = $this->imageService->setImageString($validated['meta_image'])->save();
        }

        try {
            $category = $this->categoryService->save($userData, $request->id);
        } catch (\Throwable $th) {
            return Redirect::back()->with('error', "Something went wrong. Please try again later.");
        }

        return redirect()
            ->route('admin.catalog.category.edit', ['id' => $category->id])
            ->with('success', 'Category created successfully');
    }
}
