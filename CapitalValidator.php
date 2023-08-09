<?php

require_once('ValidatorInterface.php');
require_once('ValidationResponse.php');
require_once('NumberToWordConvertor.php');

class CapitalValidator implements ValidatorInterface
{
    private const ERROR = '%s must contain at least %s capital letter';
    public function validate(string $str, string $variable_name, int $min): ValidationResponse
    {
        $validationResponse = new ValidationResponse();
        $numberOfCapitalCharacter = $this->getNumberOfCapticalCharacters($str);

        if($numberOfCapitalCharacter < $min)
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

    private function getNumberOfCapticalCharacters(string $str)
    {
        $counter = 0;
        for($i = 0; $i < strlen($str); $i++)
        {
            if(ctype_upper($str[$i]))
            {
                $counter++;
            }
        }
        return $counter;
    }
}