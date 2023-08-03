<?php

require_once('ValidationResponse.php');

class PasswordValidator
{
    public const ERROR_LENGTH_INVALID = 'Password must be at least 8 characters';
    public const ERROR_NUMERIC_INVALID = 'The password must contain at least 2 numbers';
    public string $password;
    public ValidationResponse $response;
    public array $rules;
    private array $rules_functions_map =  [
        'length' => 'validateLength',
        'numeric' => 'validateNumericCharacters',
        'capital' => 'validateCapital',
    ];

    public function __construct(string $password, array $rules)
    {
        $this->password = $password;
        $this->response = new ValidationResponse();
        $this->rules = $rules;
    }
    
    public function validate()
    {
        foreach ($this->rules as $rule) {
            $functaion_name = $this->rules_functions_map[$rule];
            $this->$functaion_name();
        }

        return $this->response;
    }

    private function validateLength()
    {
        if (strlen($this->password) < 8) 
        {
            $this->response->addError(self::ERROR_LENGTH_INVALID);
        }
    }

    private function validateNumericCharacters()
    {
        $countNumericCharacters = $this->countNumericCharacters();
        if ($countNumericCharacters < 2)
        {
            $this->response->addError(self::ERROR_NUMERIC_INVALID);
        }
    }

    private function countNumericCharacters()
    {
        $count = 0;
        for ($i = 0; $i < strlen($this->password); $i++){
            if (is_numeric($this->password[$i])){
                $count++;
            }
        }
        return $count;
    }

    private function validateCapital()
    {
    }


}