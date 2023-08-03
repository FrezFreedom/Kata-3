<?php


class ValidationResponse
{
    public bool $valid;
    public array $errors;
    
    public function __construct()
    {
        $this->valid = true;
        $this->errors = [];
    }

    public function addError(string $error)
    {
        $this->valid = false;
        $this->errors[] = $error;
    }
}