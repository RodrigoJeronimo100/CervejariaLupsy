<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;

class RateBeerCest
{
    public function rateBeer(FunctionalTester $I)
    {
        $I->amOnPage('/index.php?r=site%2Flogin');
        $I->fillField('LoginForm[username]', 'cliente');
        $I->fillField('LoginForm[password]', 'Cliente123');
        $I->click('login-button');
        $I->click('Cerveja');
        $I->click('Sagres');
        $I->click('span.star[data-rating="5"]');
        $I->see('Thank you for your rating');
    }
}
