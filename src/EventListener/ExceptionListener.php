<?php
declare(strict_types=1);

namespace App\EventListener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Throwable;

final class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();
        $message = $exception->getMessage();

        $response = new Response();
        $response->setContent($message);

        $error = [
            'message' => $exception->getMessage(),
        ];

        $response = new JsonResponse($error, $this->getStatusCodeFromException($exception));

        $event->setResponse($response);
    }

    private function getStatusCodeFromException(Throwable $exception): int
    {
        if ($exception instanceof HttpException) {
            return $exception->getCode();
        }

        return 500;
    }
}


