<?php

require_once('ValidationResponse.php');

class PasswordValidator
{
    public const ERROR_LENGTH_INVALID = 'Password must be at least 8 characters';
    public string $password;
    public ValidationResponse $response;

    public function __construct(string $password)
    {
        $this->password = $password;
        $this->response = new ValidationResponse();
    }
    
    public function validate()
    {
        $this->validateLength();

        return $this->response;
    }

    private function validateLength()
    {
        if (strlen($this->password) < 8) 
        {
            $this->response->addError(self::ERROR_LENGTH_INVALID);
        }
    }



}