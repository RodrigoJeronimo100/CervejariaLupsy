<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;

class RateBeerCest
{
    public function rateBeer(FunctionalTester $I)
    {
        $I->amOnPage('/index.php?r=site%2Flogin');
        $I->fillField('#loginform-username', 'cliente2');
        $I->fillField('#loginform-password', 'Cliente123');
        $I->click('login-button');
        $I->click('Cerveja');
        $I->click('Sagres');
        $I->click('span.star[data-rating="5"]');
        $I->see('Thank you for your rating');
    }
}
