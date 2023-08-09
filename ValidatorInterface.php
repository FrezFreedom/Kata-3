<?php


interface ValidatorInterface
{
    public function validate(string $str, string $variable_name, int $min): ValidationResponse;
}