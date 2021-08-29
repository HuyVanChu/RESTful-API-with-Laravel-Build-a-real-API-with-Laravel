<?php

namespace App\Exceptions;

use App\Traits\ApiResponser;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;

class Handler extends ExceptionHandler
{
    use ApiResponser;
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
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
     * No chay khi xuat hien 1 ngoai le
     */
    public function render($request, Exception $exception)
    {

        // return parent::render($request, $exception);

        /**
         * Hien thi validate request. Khi submit form khong co du lieu, thay vi xuat hien loi thi hien thi thong bao
         */
        if ($exception instanceof ValidationException) {
            return $this->convertValidationExceptionToResponse($exception,$request);
        }
        /**
         * Truy cap du lieu trong
         */
        if ($exception instanceof ModelNotFoundException) {
            return $this->errorResponser("404 - NotFound",404);
        }
        if ($exception instanceof AuthenticationException) {
            return $this->unauthenticated($request, $exception);
        }
        if ($exception instanceof AuthorizationException) {
            return $this->errorResponser($exception->getMessage(),403);
        }
        /**
         * Truy cap link sai -> khong tim thay trang
         * https://www.youtube.com/watch?v=EYDI-RnP0A4
         * 15. Handling Errors and Exceptions with the Laravel Handler
         * bai 5: Handling NotFoundHttpException
         */
        if ($exception instanceof NotFoundHttpException) {
            return $this->errorResponser('Trang khong ton tai',403);
        }
        /**
         * Voi method POST de tao ban ghi moi, nhung nguoi dung truy cap bang GET
         */
        if ($exception instanceof MethodNotAllowedHttpException) {
            return $this->errorResponser('Phuong thuc dang thuc hien khong duoc ho tro',405);
        }
        /**
         * Trong thuc te co rat nhieu loi, neu cac ngoai le do chua dc xu ly o tren thi thay bang cai nay. No se khong hien thi loi
         */
        if ($exception instanceof HttpException) {
            return $this->errorResponser($exception->getMessage(),$exception->getStatusCode());
        }
        if ($exception instanceof QueryException) {
            $errorCode=$exception->errorInfo[1];
            if ($errorCode==1451) {
                return $this->errorResponser('Khong the thuc hien Yc nay tren CSDL, hay xem lai', 409);
            }
            
        }

        return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return $this->errorResponser("Unauthenticated", 401);
    }
    // protected function unauthenticated($request, AuthenticationException $exception)
    // {
    //     if ($request->expectsJson()) {
    //         return response()->json(['error' => 'Unauthenticated.'], 401);
    //     }

    //     return redirect()->guest(route('login'));
    // }
    protected function convertValidationExceptionToResponse(ValidationException $e, $request)
    {
        $errors=$e->validator->errors()->getMessages();
        return $this->errorResponser($errors, 422);
    }
}
