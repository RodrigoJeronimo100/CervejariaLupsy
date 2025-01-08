<?php

namespace frontend\tests\unit\models;

use common\models\User;

class UserTest extends \Codeception\Test\Unit
{
    public function testValidateEmptyUser()
    {
        $user = new User();

        $this->assertFalse($user->validate(), 'User should not validate when empty');
        $this->assertArrayHasKey('username', $user->errors);
        $this->assertArrayHasKey('email', $user->errors);
        $this->assertArrayHasKey('password_hash', $user->errors);
    }

    public function testValidateInvalidEmail()
    {
        $user = new User();
        $user->username = 'tester';
        $user->email = 'invalid-email';
        $user->password_hash = 'password123';

        $this->assertFalse($user->validate(), 'User should not validate with invalid email');
        $this->assertArrayHasKey('email', $user->errors);
    }

    public function testValidateValidUser()
    {
        $user = new User();
        $user->username = 'tester';
        $user->email = 'tester@example.com';
        $user->password_hash = 'password123';

        $this->assertTrue($user->validate(), 'User should validate with correct data');
    }
}
