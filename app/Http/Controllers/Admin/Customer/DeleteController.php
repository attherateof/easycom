<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;

class DeleteController extends Controller
{
    /**
     * @param User $user
     */
    public function __construct(private readonly User $user)
    {
    }

    /**
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    public function __invoke(Request $request): JsonResponse|RedirectResponse
    {
        $dataOnly = $request->header('Data-Only', false);
        try {
            $this->user::destroy($request->ids);
            $type = "success";
            $message = "Customer deleted successfully.";
        } catch (\Throwable $th) {
            $type = "error";
            $message = $th->getMessage();
        }

        return $dataOnly ? response()->json([$type => $message]) : Redirect::back()->with($type, $message);
    }
}
