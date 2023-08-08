<?php

require_once('ValidatorInterface.php');
require_once('ValidationResponse.php');
require_once('NumberToWordConvertor.php');

class SpecialValidator implements ValidatorInterface
{
    private const ERROR = '%s must contain at least %s special character';
    private const SPECIAL_CHARACTERS = "!@#$%^&*()_+-={}[]|\\:;'\"><,.?/`~";

    public function validate(string $str, int $min, string $variable_name): ValidationResponse
    {
        $validationResponse = new ValidationResponse();
        $numberOfSpecialCharacter = $this->getNumberOfSpecialCharacters($str);
        if($numberOfSpecialCharacter < $min)
        {
            $error = $this->generateErrorMessage($min, $variable_name);
            $validationResponse->addError($error);
        }
        return $validationResponse;
    }

    private function generateErrorMessage(int $min, string $variable_name): string
    {
        $numberToWord = new NumberToWordConvertor();
        $minWord = $numberToWord->intToWord($min);
        return sprintf(self::ERROR, $variable_name, $minWord);
    }

    private function getNumberOfSpecialCharacters(string $str)
    {
        $counter = 0;
        for($i = 0; $i < strlen($str); $i++)
        {
            if( str_contains(self::SPECIAL_CHARACTERS, $str[$i]) )
            {
                $counter++;
            }
        }
        return $counter;
    }
}