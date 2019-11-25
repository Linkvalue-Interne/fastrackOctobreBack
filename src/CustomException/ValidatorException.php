<?php


namespace App\CustomException;

use Throwable;

class ValidatorException extends \Symfony\Component\Validator\Exception\ValidatorException
{
    /** @var array */
    private $errors;

    public function __construct(array $errors = [], $code = 0, Throwable $previous = null)
    {
        parent::__construct('form is not valid', $code, $previous);
        $this->errors = $errors;
    }

    /**
     *  Entity constraint errors
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
