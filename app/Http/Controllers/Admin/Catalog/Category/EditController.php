<?php

namespace App\Http\Controllers\Admin\Catalog\Category;

use App\Http\Controllers\Controller;
use App\Models\Catalog\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class EditController extends Controller
{
    /**
     * Class SaveController
     *
     * This controller is responsible for saving customer data.
     */
    public function __construct(private readonly Category $categoryModel)
    {
    }

    public function __invoke(int $id): Response
    {
        $Categories = $this->categoryModel::orderBy('sort_order', 'ASC')
            ->select('id', 'title', 'parent_id')
            ->get()
            ->toArray();

        $Category = $this->categoryModel::findOrFail($id);

        return Inertia::render('Catalog/Category/Edit',
            [
                "categories" => $Categories,
                "category" => $Category
            ]
        );
    }
}
