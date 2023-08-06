<?php

require_once('ValidatorInterface.php');
require_once('ValidationResponse.php');

class NumericValidator implements ValidatorInterface
{
    private const ERROR = 'The %s must contain at least %u numbers';
    public function validate(string $str, int $min, string $variable_name): ValidationResponse
    {
        $validationResponse = new ValidationResponse();
        $numberOfNumericCharacter = $this->getNumberOfNumericCharacter($str);

        if($numberOfNumericCharacter < $min)
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

    private function getNumberOfNumericCharacter(string $str)
    {
        $counter = 0;
        for($i = 0; $i < strlen($str); $i++)
        {
            if(ctype_digit($str[$i]))
            {
                $counter++;
            }
        }
        return $counter;
    }
}