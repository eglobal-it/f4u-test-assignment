<?php

namespace App\Project\Api\Exception;

use Exception;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ValidationException extends Exception
{
    /**
     * @var ConstraintViolationListInterface
     */
    private $errors;

    /**
     * @return ConstraintViolationListInterface
     */
    public function getErrors(): ConstraintViolationListInterface
    {
        return $this->errors;
    }

    /**
     * @param ConstraintViolationListInterface $errors
     *
     * @return ValidationException
     */
    public function setErrors(ConstraintViolationListInterface $errors): ValidationException
    {
        $this->errors = $errors;

        return $this;
    }
}
