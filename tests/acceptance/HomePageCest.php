<?php

class HomePageCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTestHomePageSuccess(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->see('Products');
        $I->see('Delivery');
    }
}
