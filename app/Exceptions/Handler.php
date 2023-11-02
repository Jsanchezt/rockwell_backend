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
    public function render($request, Exception $exception)
    {

        if (get_class($exception) === 'Illuminate\Validation\ValidationException'){
            return response()->json(['status' => 'error', 'message' => $exception->getMessage(), 'errors' => $exception->errors()], 422);
        }

        if (get_class($exception) === 'Illuminate\Database\QueryException'){
            return response()->json(['status' => 'error', 'message' => "db error"], 422);
        }

        if (get_class($exception) === 'App\Exceptions\UserRegistered'){
            return response()->json(['status' => 'error', 'message' => "user already exists"], 423);
        }


        return parent::render($request, $exception);
    }
}
