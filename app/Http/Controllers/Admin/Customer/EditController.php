<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Http\Controllers\Controller;
use App\Models\User;
use Inertia\Inertia;

class EditController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($id)
    {
        $user = User::findOrFail($id);

        return Inertia::render('Customer/Edit', [
            "customer" => $user
        ]);
    }
}
