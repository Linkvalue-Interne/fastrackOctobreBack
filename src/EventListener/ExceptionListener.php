<?php


namespace App\EventListener;

use App\CustomException\InvalidArgumentException;
use App\CustomException\ValidatorException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getException();
        $errors = [];

        switch ($exception) {
            case $exception instanceof ValidatorException:
                $errors = [
                    'status' => Response::HTTP_BAD_REQUEST,
                    'message' => $exception->getErrors(),
                    ]
                ;
                break;
            case $exception instanceof InvalidArgumentException:
                $errors = [
                    'status' => Response::HTTP_NOT_FOUND,
                    'message' => $exception->getMessage(),
                    ]
                ;
                break;
            case $exception instanceof \InvalidArgumentException:
                $errors = [
                    'status' => Response::HTTP_BAD_REQUEST,
                    'message' => $exception->getMessage(),
                    ]
                ;
                break;
            case $exception instanceof NotFoundHttpException:
                $errors = [
                    'status' => Response::HTTP_BAD_REQUEST,
                    'message' => $exception->getMessage(),
                    ]
                ;
                break;
            default:
                $errors = [
                    'status' => $exception->getCode(),
                    'message' => $exception->getMessage(),
                ]
                ;
        }

        $event->setResponse(new JsonResponse($errors, $errors['status']));
    }
}
