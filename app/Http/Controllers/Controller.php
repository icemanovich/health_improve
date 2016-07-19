<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Response;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param null $data
     * @param array $headers
     * @param int $status
     * @return mixed
     */
    public static function showSuccess($data = null, array $headers = [], $status = 200)
    {
        return Response::json([ 'data' => $data, 'status' => 'ok' ], $status, $headers);
    }

    /**
     * @param null $message
     * @param array $headers
     * @param int $status
     * @return mixed
     */
    public static function showError($message = null, array $headers = [], $status = 200)
    {
        return Response::json([ 'data' => $message, 'status' => 'error' ], $status, $headers);
    }
}
