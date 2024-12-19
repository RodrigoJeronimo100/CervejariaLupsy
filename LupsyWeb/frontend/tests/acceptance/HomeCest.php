<?php

namespace frontend\tests\acceptance;

use frontend\tests\AcceptanceTester;
use yii\helpers\Url;

class HomeCest
{
    public function checkHome(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->wait(2);
        $I->see('Descobre uma nova experiência de cervejas com a nossa aplicação e website que une amantes de cervejas a partir da nossa comunidade.');
/*
        $I->seeLink('About');
        $I->click('About');
        $I->wait(2); // wait for page to be opened

        $I->see('This is the About page.');*/
    }
}
