<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;

class SearchBeerCest
{
    public function searchBeer(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->fillField('search', 'Sagres');
        $I->click('search-button');
        $I->see('Sagres');
    }
}
