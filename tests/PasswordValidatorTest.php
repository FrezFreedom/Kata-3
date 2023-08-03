<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
require_once( __DIR__ . '/../PasswordValidator.php');

final class PasswordValidatorTest extends TestCase
{
    public function test_eight_character_length_validation(): void
    {
        $passwordValidator = new PasswordValidator('1234567');

        $validation = $passwordValidator->validate();

        $this->assertEquals(false, $validation->valid);
        $this->assertTrue(in_array('Password must be at least 8 characters', $validation->erros));
    }
}
