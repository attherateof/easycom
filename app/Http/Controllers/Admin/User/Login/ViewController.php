<?php

namespace App\Http\Controllers\Admin\User\Login;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class ViewController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        return Inertia::render('User/Login/View', [
            'canResetPassword' => Route::has('admin.user.password.request'),
            'status' => session('status'),
        ]);
    }
}
