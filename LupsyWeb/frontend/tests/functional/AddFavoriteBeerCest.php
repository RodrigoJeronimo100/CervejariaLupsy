<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;

class AddFavoriteBeerCest
{
    public function addFavoriteBeer(FunctionalTester $I)
    {
        $I->amOnPage('/index.php?r=site%2Flogin');
        $I->fillField('LoginForm[username]', 'cliente');
        $I->fillField('LoginForm[password]', 'Cliente123');
        $I->click('login-button');
        $I->click('Cerveja');
        $I->click('Sagres');
        $I->click('.fa.fa-heart');
        $I->see('Added to favorites');
    }
}
