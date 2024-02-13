<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ValidationException) {

            $errors = $exception->validator->errors();

            return response()->json([
                'success' => false,
                'message' => 'Ops! Some errors occurred',
                'errors' => $errors
            ], 422);
        }

        // Handle other types of exceptions resulting in status code 500
        if ($this->isHttpException($exception) && $exception->getCode() == 500) {
            // Log the exception
            error_log("Internal Server Error: " . $exception->getMessage());

            // Return a JSON response with a generic error message
            return response()->json([
                'success' => false,
                'message' => 'Internal Server Error',
            ], 500);
        }

        return parent::render($request, $exception);
    }
}
