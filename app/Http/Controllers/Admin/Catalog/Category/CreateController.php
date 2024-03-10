<?php

namespace App\Http\Controllers\Admin\Catalog\Category;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Inertia\Response;
use App\Models\Catalog\Category;

class CreateController extends Controller
{
    /**
     * Class SaveController
     *
     * This controller is responsible for saving customer data.
     */
    public function __construct(private readonly Category $categoryModel)
    {
    }

    public function __invoke(Request $request): Response
    {
        $Categories = $this->categoryModel::orderBy('sort_order', 'ASC')
            ->select('id', 'title', 'parent_id')
            ->get()
            ->toArray();

        return Inertia::render('Catalog/Category/Create',
            [
                "categories" => $Categories
            ]
        );
    }
}
