<?php

class SingInPageCest
{
    // tests
    public function tryToTestSignInWithValidData(AcceptanceTester $I)
    {
        $I->amOnPage('/account/login');
        $I->fillField('login', 'Nick');
        $I->fillField('pass', 'testTest52');
        $I->click('Sign In');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
        $I->amOnPage('/');
        $I->see('Nick');
    }
    public function tryToTestSignInWithInvalidPassword(AcceptanceTester $I)
    {
        $I->amOnPage('/account/login');
        $I->fillField('login', 'Nick');
        $I->fillField('pass', 'test9593111');
        $I->click('Sign In');
        $I->see('Check your data!');
    }
}
