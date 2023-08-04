<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
require_once( __DIR__ . '/../PasswordValidator.php');

final class PasswordValidatorTest extends TestCase
{
    public function test_eight_character_length_validation_happy(): void
    {
        $passwordValidator = new PasswordValidator();

        $validation = $passwordValidator->validate('12345678');

        $this->assertTrue($validation->valid);
        $this->assertFalse(in_array('Password must be at least 8 characters', $validation->errors));
    }

    public function test_eight_character_length_validation_unhappy(): void
    {
        $passwordValidator = new PasswordValidator();

        $validation = $passwordValidator->validate('1234567');

        $this->assertFalse($validation->valid);
        $this->assertTrue(in_array('Password must be at least 8 characters', $validation->errors));
    }

    public function test_numeric_characters_validation_happy(): void
    {
        $passwordValidator = new PasswordValidator();

        $validation = $passwordValidator->validate('ABCDEFG12');

        $this->assertTrue($validation->valid);
        $this->assertFalse(in_array('The password must contain at least 2 numbers', $validation->errors));
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
