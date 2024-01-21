<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\User;

class ListController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $itemsPerPage = ($request->items_per_page) ?: 10;
        $dataOnly = $request->header('Data-Only', false);
        $users = User::orderBy('id','desc')->paginate($itemsPerPage);
        $headers = [
            [
                "title" => "ID",
                "align" => "start",
                "sortable" => true,
                "key" => "id",
            ],
            [
                "title" => "Prefix",
                "align" => "end",
                "sortable" => false,
                "key" => "prefix",
            ],
            [
                "title" => "First Name",
                "align" => "end",
                "sortable" => false,
                "key" => "first_name",
            ],
            [
                "title" => "Middle Name",
                "align" => "end",
                "sortable" => false,
                "key" => "middle_name",
            ],
            [
                "title" => "Last Name",
                "align" => "end",
                "sortable" => false,
                "key" => "last_name",
            ],
            [
                "title" => "Email",
                "align" => "end",
                "sortable" => false,
                "key" => "email",
            ],
            [
                "title" => "Phone",
                "align" => "end",
                "sortable" => false,
                "key" => "phone",
            ],
            [
                "title" => "DOB",
                "align" => "end",
                "sortable" => false,
                "key" => "dob",
            ],
            [
                "title" => "Created At",
                "align" => "end",
                "sortable" => true,
                "key" => "created_at",
            ],
            [
                "title" => "Actions",
                "align" => "end",
                "sortable" => false,
                "key" => "actions",
            ]
        ];
        if ($dataOnly) {
            return response()->json([
                "customers" => $users
            ]);
        } else {
            return Inertia::render('Customer/List', [
                "headers" => $headers,
                "customers" => $users
            ]);
        }

    }
}