<?php


namespace App\EventListener;

use App\CustomException\FormRequiredException;
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
                    'status' => $exception->getCode(),
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
            case $exception instanceof FormRequiredException:
                $errors = [
                    'status' => $exception->getCode(),
                    'message' => $exception->formatMessage(),
                    ]
                ;
                break;
        }

        $event->setResponse(new JsonResponse($errors));
    }
}
