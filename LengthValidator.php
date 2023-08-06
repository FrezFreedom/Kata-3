<?php

require_once('ValidatorInterface.php');
require_once('ValidationResponse.php');

class LengthValidator implements ValidatorInterface
{
    private const ERROR = '%s must be at least %u characters';
    public function validate(string $str, int $min, string $variable_name): ValidationResponse
    {
        $validationResponse = new ValidationResponse();

        if(strlen($str) < $min)
        {
            $error = $this->generateErrorMessage($min, $variable_name);
            $validationResponse->addError($error);
        }
        return $validationResponse;
    }

    private function generateErrorMessage(int $min, string $variable_name): string
    {
        return sprintf(self::ERROR, $variable_name, $min);
    }
}