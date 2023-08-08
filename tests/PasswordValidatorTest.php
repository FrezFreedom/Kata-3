<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
require_once( __DIR__ . '/../PasswordValidator.php');
require_once( __DIR__ . '/../ValidationResponse.php');

final class PasswordValidatorTest extends TestCase
{

    /**
     * @dataProvider provideLengthValidationData
     */
    public function test_password_validation($expectedResult, $input): void
    {
        $passwordValidator = new PasswordValidator();

        $validation = $passwordValidator->validate($input);

        $this->assertSame($expectedResult->valid, $validation->valid);
        $this->assertSame($expectedResult->errors, $validation->errors);
    }

    public static function provideLengthValidationData()
    {
        $validationResponse = new ValidationResponse();
        yield 'length validation no problem state'  => [
            $validationResponse,
            'A@345678',
        ];

        $validationResponse = new ValidationResponse();
        $validationResponse->addError('Password must be at least 8 characters');
        yield 'length validation problem state'  => [
            $validationResponse,
            'A@34567',
        ];

        $validationResponse = new ValidationResponse();
        yield 'numeric validation no problem state'  => [
            $validationResponse,
            'A@CDEFG12',
        ];
        
        $validationResponse = new ValidationResponse();
        $validationResponse->addError('The password must contain at least 2 numbers');
        yield 'numeric validation problem state'  => [
            $validationResponse,
            'A@CDEFG1',
        ];

        $validationResponse = new ValidationResponse();
        $validationResponse->addError('password must contain at least one capital letter');
        yield 'capital validation problem state'  => [
            $validationResponse,
            'a@cdefg12',
        ];

        $validationResponse = new ValidationResponse();
        yield 'capital validation no problem state'  => [
            $validationResponse,
            'A@cdefg12',
        ];

        $validationResponse = new ValidationResponse();
        $validationResponse->addError('password must contain at least one special character');
        yield 'special validation problem state'  => [
            $validationResponse,
            'Abcdefg12',
        ];

        $validationResponse = new ValidationResponse();
        yield 'special validation no problem state'  => [
            $validationResponse,
            '@Abcdefg12',
        ];
    }


    // public function test_capital_character_false_validation(): void
    // {
    //     $passwordValidator = new PasswordValidator('abc', ['capital']);

    //     $validation = $passwordValidator->validate();

    //     $this->assertFalse($validation->valid);
    //     $this->assertTrue(in_array('password must contain at least one capital letter', $validation->errors));
    // }

    // public function test_capital_character_true_validation(): void
    // {
    //     $passwordValidator = new PasswordValidator('Abc', ['capital']);

    //     $validation = $passwordValidator->validate();

    //     $this->assertTrue($validation->valid);
    //     $this->assertFalse(in_array('password must contain at least one capital letter', $validation->errors));
    // }
}
