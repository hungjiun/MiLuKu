<?php

namespace App\Exceptions;

use Throwable;
use App\Http\Responses\ECExtensionResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Arr;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Symfony\Component\Process\Exception\ProcessTimedOutException::class,
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

    protected $internalDontReport = [];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    private function formatValidationExceptionMessage(ValidationException $exception): string
    {
        return join(PHP_EOL, $exception->validator->errors()->all());
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response|MMRMExtensionResponse
     */
    public function render($request, Throwable $exception)
    {
        $statusCode = ECException::ERROR_CODE_UNKNOWN;

        $message = '';
        if (config('app.debug')) {
            $message = $exception->getMessage();
        }

        if ($exception instanceof ECException) {
            $statusCode = $exception->getCode();
        } else if ($exception instanceof ValidationException) {
            $statusCode = ECException::ERROR_CODE_VALIDATION_EXCEPTION;
            $messages = array_flatten(array_values($exception->errors()));
            $message = implode(",", json_decode(json_encode($messages, JSON_UNESCAPED_UNICODE))) ;
        } else if (str_contains($message, 'a foreign key constraint')) {
            $statusCode = ECException::ERROR_FOREIGN_KEY_CONSTRAINT_VIOLATION;
        }

        return new ECExtensionResponse(
            null,
            $statusCode,
            $message
        );
    }
}
