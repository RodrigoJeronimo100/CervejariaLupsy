<?php

namespace frontend\tests\acceptance;

use frontend\tests\AcceptanceTester;
use yii\helpers\Url;

class loginCest
{
    public function tchimCerverja(AcceptanceTester $I)
    {
        $I->amOnPage('/index.php?r=site%2Flogin');
        $I->fillField('#loginform-username', 'cliente2');
        $I->fillField('#loginform-password', 'Cliente123');
        $I->see('Entrar');
        $I->click('login-button');
        $I->wait(2);
        $I->click('Cerveja');
        $I->see('Sagres');
        $I->wait(2);
        $I->click('Sagres');
        $I->wait(2);
        $I->seeElement('.fa.fa-heart');
        $I->click('.fa.fa-heart');
        $I->wait(2);
        $I->see('TCHIM-TCHIM');
        $I->click('TCHIM-TCHIM');
        $I->wait(5);
        $I->acceptPopup(); // Aceita o alerta (ou use $I->dismissPopup() para dispensar o alerta)
        $I->wait(5);
        $I->see('Favoritos');
        $I->click('Favoritos');
        $I->wait(5);
        $I->see('Historico');
        $I->click('Historico');
        $I->wait(2);
    }
}
