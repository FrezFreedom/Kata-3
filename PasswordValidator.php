<?php

require_once('ValidationResponse.php');
require_once('LengthValidator.php');
require_once('NumericValidator.php');
require_once('CapitalValidator.php');
require_once('ValidatorInterface.php');

class PasswordValidator
{

    public function validate(string $password): ValidationResponse
    {
        $response = new ValidationResponse();;

        $this->validateLength($password, $response);

        $this->validateNumeric($password, $response);

        $this->validateCapital($password, $response);

        return $response;
    }

    private function validateCapital(string $password, ValidationResponse $response): void
    {
        $capitalValidator = new CapitalValidator();
        $numericValidationResponse = $capitalValidator->validate($password, 1, 'password');
        $this->processValidation( $numericValidationResponse, $response );
    }

    private function validateLength(string $password, ValidationResponse $response): void
    {
        $lengethValidation = new LengthValidator();
        $lengthValidationResponse = $lengethValidation->validate($password, 8, 'Password');
        $this->processValidation( $lengthValidationResponse ,$response );
    }

    private function validateNumeric(string $password, ValidationResponse $response): void
    {
        $numericValidator = new NumericValidator();
        $numericValidationResponse = $numericValidator->validate($password, 2, 'password');
        $this->processValidation( $numericValidationResponse, $response );
    }

    private function processValidation(ValidationResponse $validationResponse,
                                       ValidationResponse $response): void
    {
        if( ! $validationResponse->valid )
        {
            $response->addError( $validationResponse->errors[0] );
        }
    }
}