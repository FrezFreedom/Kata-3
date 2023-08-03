<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
require_once( __DIR__ . '/../PasswordValidator.php');

final class PasswordValidatorTest extends TestCase
{
    public function test_eight_character_length_validation(): void
    {
        $passwordValidator = new PasswordValidator('1234567');

        $validation = $passwordValidator->validate();

        $this->assertFalse($validation->valid);
        $this->assertTrue(in_array('Password must be at least 8 characters', $validation->errors));
    }

    public function test_numeric_characters_validation(): void
    {
        $passwordValidator = new PasswordValidator('ABC1');

        $validation = $passwordValidator->validate();

        $this->assertFalse($validation->valid);
        $this->assertTrue(in_array('The password must contain at least 2 numbers', $validation->errors));
    }
}
