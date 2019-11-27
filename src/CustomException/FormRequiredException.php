<?php


namespace App\CustomException;

use Throwable;

class FormRequiredException extends \Exception
{
    /** @var array */
    private $fieldRequired;

    public function __construct($message = [], $code = 400, Throwable $previous = null)
    {
        parent::__construct('field required', $code, $previous);
        $this->fieldRequired = $message;
    }

    public function formatMessage()
    {
        $fields = array_flip($this->fieldRequired);
        $arrayFormat = [];

        foreach ($fields as $field) {
            $arrayFormat[$field] = 'field is required';
        }

        return $arrayFormat;
    }
}
