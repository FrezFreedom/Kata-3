<?php

require_once('ValidationResponse.php');
require_once('LengthValidator.php');
require_once('ValidatorInterface.php');

class PasswordValidator implements validatorInterface
{
    public ValidationResponse $response;

    public function __construct()
    {
        $this->response = new ValidationResponse();
    }
    
    public function validate(string $password): ValidationResponse
    {
        $this->validateLength($password);

        return $this->response;
    }

    private function validateLength(string $password)
    {
        $lengethValidation = new LengthValidator();
        $lengthValidationResponse = $lengethValidation->validate($password);
        $this->processValidation( $lengthValidationResponse );
    }

    private function processValidation($validationResponse)
    {
        if( ! $validationResponse->valid )
        {
            $this->response->addError( $validationResponse->errors[0] );
        }
    }
}