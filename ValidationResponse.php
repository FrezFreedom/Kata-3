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
}