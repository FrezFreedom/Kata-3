<?php

require_once('ValidatorInterface.php');
require_once('ValidationResponse.php');

class LengthValidator implements ValidatorInterface
{
    private const ERROR = 'Password must be at least 8 characters';
    public function validate(string $password): ValidationResponse
    {
        $validationResponse = new ValidationResponse();

        if(strlen($password) < 8)
        {
            $validationResponse->addError(self::ERROR);
        }
        return $validationResponse;
    }
}