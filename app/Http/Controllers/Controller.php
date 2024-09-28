<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\LengthAwarePaginator;

abstract class Controller
{
    public function success($data = null, $code = 200, $message = 'success')
    {

        $data = $data instanceof LengthAwarePaginator ? [
            'meta' => [
                'current_page' => $data->currentPage(),
                'last_page' => $data->lastPage(),
                'total' => $data->total(),
            ],
            'list' => $data->items()
        ] : $data;

        return response()->json([
            'code' => $code,
            'msg' => $message,
            'data' => $data
        ]);
    }

    public function error($message = 'error', $code = 500, $data = [])
    {
        return response()->json([
            'code' => $code,
            'msg' => $message,
            'data' => $data
        ]);
    }
}
