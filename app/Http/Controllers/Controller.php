<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public const MISSING_PARAMETERS = 'MISSING_PARAMETERS';
    public const UNAUTHORIZED = 'UNAUTHORIZED';
    public const INVALID_RESOURCE = 'INVALID_RESOURCE';
    public const VALIDATION_ERROR = 'VALIDATION_ERROR';
    public const INTERNAL_ERROR = 'INTERNAL_ERROR';
    public const INVALID_CREDENTIALS = 'INVALID_CREDENTIALS';
    public const PAGINATION_LIMIT = 15;

    protected function success($result = null){
        return response()->json([
            'status' => 'SUCCESS',
            'result' => $result,
            'error'  => null,
        ]);
    }

    protected function error($code, $message, $statusCode = null) {
        $status = ($statusCode) ? $statusCode : $this->getStatusCode($code);

        return response()->json([
            'status' => 'ERROR',
            'error' => [
                'code' => $code,
                'message' => $message
            ],
        ], $status);
    }

    private function getStatusCode ($errorCode) {
        switch ($errorCode) {
            case self::MISSING_PARAMETERS:
            case self::VALIDATION_ERROR:
                return 400;
            case self::INVALID_CREDENTIALS:
                return 401;
            case self::UNAUTHORIZED:
                return 403;
            case self::INVALID_RESOURCE:
                return 404;
            case self::INTERNAL_ERROR:
            case self::UPLOAD_ERROR:
                return 500;
            default:
                return 500;
        }
    }
}
