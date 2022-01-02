<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;

class  BaseController extends Controller
{
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
            'date' => $error
        ];
        if (!empty($errorMassage)) {
            $respose['date'] = $errorMassage;
        }
        return response()->json($respose, $code);
    }
}
