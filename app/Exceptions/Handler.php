<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use \Symfony\Component\HttpFoundation\Response;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

//($e instanceof TokenInvalidException) {
//return response()->json(["error" => "Token is Invalid"], 400);
//}
//elseif ($e instanceof TokenExpiredException) {
//            return response()->json(["error" => "Token is Expired"], 400);
//        }
//        elseif

    public function render($request, Throwable $e)
    {
        if($e instanceof TokenBlacklistedException) {
            return response()->json(["error" => "Token can not be used, Get new One"],
                Response::HTTP_BAD_REQUEST);
        }
        elseif($e instanceof TokenInvalidException) {
            return response()->json(["error" => "Token is Invalid."],
                Response::HTTP_BAD_REQUEST);
        }
        elseif($e instanceof TokenExpiredException) {
            return response()->json(["error" => "Token is Expired, Get new One"],
                Response::HTTP_BAD_REQUEST);
        }
        elseif($e instanceof JWTException) {
            return response()->json(["error" => "Token is not Provided."],
                Response::HTTP_BAD_REQUEST);
        }


        return parent::render($request, $e);
    }

}

