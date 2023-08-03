<?php

require_once('ValidationResponse.php');

class PasswordValidator
{
    public string $password;
    public ValidationResponse $response;

    public function __construct(string $password)
    {
        $this->password = $password;
        $this->response = new ValidationResponse();
    }
    
    public function validate()
    {
        return $this->response;
    }



}