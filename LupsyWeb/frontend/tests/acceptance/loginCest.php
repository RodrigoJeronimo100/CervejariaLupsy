<?php

namespace frontend\tests\acceptance;

use frontend\tests\AcceptanceTester;
use yii\helpers\Url;

class loginCest
{
    public function login(AcceptanceTester $I)
    {
        $I->login('admin', 'Admin123');
        $I->wait(2);
    }
}
