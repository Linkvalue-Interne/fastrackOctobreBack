<?php


namespace App\EventListener;

use App\CustomException\InvalidArgumentException;
use App\CustomException\ValidatorException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getException();
        $errors = [];

        switch ($exception) {
            case $exception instanceof ValidatorException:
                $errors = [
                    'error' => $exception->getCode(),
                    'message' => $exception->getErrors(),
                    ]
                ;
                break;
            case $exception instanceof InvalidArgumentException:
                $errors = [
                    'status' => $exception->getCode(),
                    'message' => $exception->getMessage(),
                    ]
                ;
                break;
        }

        $event->setResponse(new JsonResponse($errors));
    }
}
