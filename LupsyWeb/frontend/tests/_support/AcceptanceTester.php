<?php

declare(strict_types=1);

namespace frontend\tests;

/**
 * Inherited Methods
 * @method void wantTo($text)
 * @method void wantToTest($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method void pause($vars = [])
 *
 * @SuppressWarnings(PHPMD)
 */
class AcceptanceTester extends \Codeception\Actor
{
    use _generated\AcceptanceTesterActions;

    /**
     * Define custom actions here
     */

    public function login($username, $password)
    {
        $I = $this;
        $I->amOnPage('/index.php?r=site%2Flogin');
        $I->fillField('Username', $username);
        $I->fillField('Password', $password);
        $I->click('login-button');
        $I->wait(2);
        $I->click('Cerveja');
        $I->wait(2);
        $I->click('Skol');
        $I->click('login-button');
    }
}
