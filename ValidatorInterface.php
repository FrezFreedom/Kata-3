<?php


interface ValidatorInterface
{
    public function validate(string $str, int $min, string $variable_name): ValidationResponse;
}