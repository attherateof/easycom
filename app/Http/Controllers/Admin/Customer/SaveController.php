<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

class SaveController extends Controller
{

    public function __construct(private readonly User $user)
    {

    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        try {
            $this->user::create([
                "first_name" => $request->first_name,
                "last_name" => $request->last_name,
                "middle_name" => $request->middle_name,
                "email" => $request->email,
                "phone" => $request->phone,
                "dob" => $request->dob,
                "password" => Hash::make($request->email),
            ]);
        } catch (\Throwable $th) {
            
            return Redirect::back()->with('error', 'Customer already exists.');
        }


        return Redirect::back()->with('success', 'Customer created.');
    }
}
