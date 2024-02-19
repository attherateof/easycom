<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;

class DeleteController extends Controller
{

    public function __construct(private readonly User $user)
    {

    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $type = "";
        $message = "";
        $dataOnly = $request->header('Data-Only', false);
        try {
            $this->user::destroy($request->ids);
            $type = "success";
            $message = "Customer deleted successfully.";
        } catch (\Throwable $th) {
            $type = "error";
            $message = $th->getMessage();
        }
        $response = $dataOnly ? response()->json([$type => $message]) : Redirect::back()->with($type, $message);
        
        return $response;
    }
}
