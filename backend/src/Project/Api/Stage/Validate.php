<?php

declare(strict_types=1);

namespace App\Project\Api\Stage;

use App\Project\Api\Exception\ValidationException;
use App\Project\Infrastructure\Common\Request\ValidatedInterface;
use League\Pipeline\StageInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class Validate implements StageInterface
{
    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @param ValidatorInterface $validator
     */
    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @param ValidatedInterface $payload
     *
     * @return ValidatedInterface
     * @throws ValidationException
     */
    public function __invoke($payload): ValidatedInterface
    {
        $errors = $this->validator->validate($payload);
        if (count($errors) > 0) {
            throw (new ValidationException('Validation failed'))->setErrors($errors);
        }

        return $payload;
    }
}
