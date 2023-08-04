<?php


interface ValidatorInterface
{
    public function validate(string $password): ValidationResponse;
}