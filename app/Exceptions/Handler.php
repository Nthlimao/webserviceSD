<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception) {
        if ($exception instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
            return $this->displayError('TOKEN_EXPIRED', 'Sua sessão expirou.', $exception->getStatusCode(), $exception);
        }

        if ($exception instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
            return $this->displayError('TOKEN_INVALID', 'Token de acesso inválido.', $exception->getStatusCode(), $exception);
        }
        
        if ($exception instanceof \Tymon\JWTAuth\Exceptions\JWTException) {
            return $this->displayError('JWT_EXCEPTION', 'Você precisa estar logado.', $exception->getStatusCode(), $exception);
        }
        
        if ($exception instanceof \Tymon\JWTAuth\Exceptions\TokenBlacklistedException){
            return $this->displayError('TOKEN_BLACKLISTED', 'Seu token de acesso se encontra na blacklist.', $exception->getStatusCode(), $exception);
        }

        if ($exception instanceof AppException) {
            return $exception->response();
        }

        return $this->displayError(
            'INTERNAL_ERROR',
            'Ocorreu um erro ao tentar processar a requisição.',
            500,
            $exception
        );
    }

    private function displayError ($code, $message, $status = 500, $exception = null) {
        $response = [
            'status' => 'ERROR',
            'error' => [
                'code' => $code,
                'message' => $message
            ],
        ];

        if (env('APP_DEBUG', false)) {
            $response['exception'] = [
                'message' => $exception->getMessage(),
                'file' => $exception->getFile() . ':' . $exception->getLine()
            ];
        }

        return response()->json($response, $status);
    }
}
