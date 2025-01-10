<?php

namespace common\tests\unit;

use common\models\User;
use common\tests\UnitTester;
use yii\db\Exception as yiiDbException;

class UserTest extends \Codeception\Test\Unit
{
    private const STRING_81_CHARS = 'KWKaiqcEYpwaPLxLblsXWjJClUvWzCKPFZGhpoZtbfvWUsysDUoSUojkEyKXQiPeSXwRfYlLsOvksbWgaaaaaaaaaa';
    private const VALID_USERNAME = 'tester';
    private const VALID_EMAIL = 'tester@example.com';
    private const VALID_PASSWORD = 'password123';

    protected UnitTester $tester;

    protected function _before()
    {
        $user = $this->createValidUser();
        $user->username = 'tester_before';
        $user->save();
    }

    protected function _after() {}

    // tests
    public function testValidations()
    {
        $user = $this->createValidUser();
        $user->username = self::STRING_81_CHARS;
        $user->email = self::STRING_81_CHARS;
        $user->password_hash = self::STRING_81_CHARS;

        $this->assertFalse($user->validate(['username']));
        $this->assertFalse($user->validate(['email']));
        $this->assertFalse($user->validate(['password_hash']));

        $user->username = null;
        $user->email = null;
        $user->password_hash = null;

        $this->assertFalse($user->validate(['username']));
        $this->assertFalse($user->validate(['email']));
        $this->assertFalse($user->validate(['password_hash']));
    }

    public function testSaveAndRead()
    {
        $user = $this->createValidUser();
        $wasSaveSuccessful = $user->save();

        $this->assertTrue($wasSaveSuccessful);

        $userFromDatabase = User::find()->where(['username' => self::VALID_USERNAME])->one();
        $this->assertNotNull($userFromDatabase);
    }

    public function testInvalidUsername()
    {
        $user = $this->createValidUser();
        $user->username = self::STRING_81_CHARS;

        try {
            $user->save(false);
            $this->assertTrue(false, "Should be returning an exception");
        } catch (\Exception $ex) {
            if ($ex instanceof yiiDbException) {
                $this->assertTrue(true);
            } else {
                $this->assertTrue(false, "Should be returning an exception of type PDOException");
            }
        }
    }

    public function testUpdate()
    {
        $user = User::find()->where(['username' => 'tester_before'])->one();
        $newUsername = 'user_new_name';

        $user->username = $newUsername;
        $user->save();

        $userFromDatabase = User::find()->where(['username' => $newUsername])->one();
        $this->assertNotNull($userFromDatabase);
    }

    public function testDelete()
    {
        $user = $this->createValidUser();
        $this->assertTrue($user->save());

        $userFromDatabase = User::findOne($user->id);
        $this->assertNotNull($userFromDatabase);

        $userFromDatabase->delete();
        $userAfterDeletion = User::findOne($user->id);
        $this->assertNull($userAfterDeletion);
    }

    private function createValidUser()
    {
        $user = new User();
        $user->username = self::VALID_USERNAME;
        $user->email = self::VALID_EMAIL;
        $user->setPassword(self::VALID_PASSWORD);
        $user->generateAuthKey();
        return $user;
    }
}
