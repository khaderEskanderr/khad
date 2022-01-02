<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function SendResponse($result, $massage)
    {
        $respose = [
            'success' => true,
            'date' => $result,
            'massage' => $massage
        ];
        return response()->json($respose, 200);
    }

    public function SendError($error, $errorMassage = [], $code = 404)
    {
        $respose = [
            'success' => false,
            'date' => $error,
        ];
        if (!empty($errorMassage)) {
            $respose['date'] = $errorMassage;
        }
        return response()->json($respose, $code);
    }
}
