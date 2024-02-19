<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

class SaveController extends Controller
{

    /**
     * Class SaveController
     * 
     * This controller is responsible for saving customer data.
     */
    public function __construct(private readonly User $user)
    {
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        try {
            $userData = [
                "first_name" => $request->first_name,
                "last_name" => $request->last_name,
                "middle_name" => $request->middle_name,
                "email" => $request->email,
                "phone" => $request->phone,
                "dob" => $request->dob,
                "password" => Hash::make($request->email),
            ];

            if (!$request->id) {
                $user = $this->user::create($userData);
            } else {
                $user = $this->user::findOrFail($request->id);
                $user->update($userData);
            }
        } catch (\Throwable $th) {
            // log here
            return Redirect::back()->with('error', 'Can not save the customer.');
        }

        return redirect()->route('admin.customer.edit', ['id' => $user->id])->with('success', 'Customer created successfully');
    }
}
