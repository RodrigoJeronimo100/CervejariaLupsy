<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;

class AddFavoriteBeerCest
{
    public function addFavoriteBeer(FunctionalTester $I)
    {
        $I->amOnPage('/index.php?r=site%2Flogin');
        $I->fillField('#loginform-username', 'admin');
        $I->fillField('#loginform-password', 'Admin123');
        $I->click('login-button');
        $I->click('Cerveja');
        $I->click('Sagres');
        $I->seeElement('.fa.fa-heart');
        $I->click('.fa.fa-heart');
        $I->wait(2);
        $I->see('Favaoritos');
        $I->click('Favoritos');
        $I->see('Sagres');
    }
}
