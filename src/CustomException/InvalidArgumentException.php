<?php


namespace App\CustomException;

use Throwable;

class InvalidArgumentException extends \InvalidArgumentException
{
    public function __construct($message = "Invalid argument", $code = 404, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
