<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function successResponse(array $data = [], int $code = 200)
    {
        $data['success'] = true;

        return response()->json($data, $code);
    }

    public function errorResponse(array $errors = [], int $code = 423)
    {
        return response()->json([
            'success' => false,
            'errors' => $errors,
        ], $code);
    }
}
