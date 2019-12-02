<?php


namespace App\CustomException;

use Throwable;

class FileException extends \Symfony\Component\HttpFoundation\File\Exception\FileException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
