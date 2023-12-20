<?php

namespace App\Exceptions;

use App\Constants\Environment;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
        $this->renderable(function (ValidationException $exception) {
            return $this->defaultErrorResponse($exception, Response::HTTP_BAD_REQUEST);
        });

        $this->renderable(function (\DomainException $exception) {
            return $this->defaultErrorResponse($exception, Response::HTTP_BAD_REQUEST);
        });

        $this->renderable(function (ModelNotFoundException|NotFoundHttpException $exception) {
            return $this->defaultErrorResponse($exception, Response::HTTP_NOT_FOUND);
        });

        $this->renderable(function (AccessDeniedHttpException $exception) {
            return $this->defaultErrorResponse($exception, Response::HTTP_FORBIDDEN);
        });

        $this->renderable(function (Exception $exception) {
            return $this->defaultErrorResponse($exception, Response::HTTP_BAD_REQUEST);
        });

        $this->reportable(function (Throwable $e) {
            Log::error($e->getMessage());
        });
    }

    public function defaultErrorResponse(Throwable $exception, int $statusCode): Response
    {
        $message = $exception->getMessage();

        if ($exception instanceof  AccessDeniedHttpException) {
            $message = 'Usuário não possui permissão para realizar essa ação';
        }
        $response = [
            'status' => $statusCode,
            'code' => $exception->getCode(),
            'data' => [
                'message' => $message,
            ],
        ];

        $response = $this->formatValidationException($exception, $response);
        $response = $this->showTrace($exception, $response);

        return response($response, $statusCode);
    }

    public function formatValidationException(Throwable $exception, array $response): array
    {
        if ($exception instanceof ValidationException) {
            $response['data']['messages'] = collect($exception->errors())->map(fn ($error) => $error[0]);
        }

        return $response;
    }

    public function showTrace(Throwable $exception, array $response): array
    {
        if (env('APP_ENV') !== Environment::PRODUCTION) {
            $response['trace'] = $exception->getTrace();
            $response['errorName'] = $exception::class;
        }

        return $response;
    }
}
