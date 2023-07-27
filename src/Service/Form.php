<?php

namespace App\Service;

use App\Entity\Model;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class Form
{
    private ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function validateRequiredFields(array $data, array $requiredFields): array
    {
        $missingFields = [];

        foreach ($requiredFields as $requiredField) {
            if (!isset($data[$requiredField])) {
                $missingFields[] = $requiredField;
            }
        }

        return $missingFields;
    }

    public function validate(Model $model): array
    {
        $errors = $this->validator->validate($model);

        if (count($errors) > 0) {
            return $this->handleErrors($errors);
        }

        return [];
    }

    private function handleErrors(ConstraintViolationListInterface $errors): array
    {
        $errorMessages = [];

        foreach ($errors as $error) {
            $errorMessages[$error->getPropertyPath()] = $error->getMessage();
        }

        return $errorMessages;
    }
}
