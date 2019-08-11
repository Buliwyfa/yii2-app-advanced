<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;
use Yii;

class HomeCest
{

    public function _before(FunctionalTester $I)
    {
        Yii::$app->language = 'en';
    }

    public function checkOpen(FunctionalTester $I)
    {
        $I->amOnPage(\Yii::$app->homeUrl);
        $I->see('Y2AA', 'h1');
        $I->seeLink('About us');
        $I->click('About us');
        $I->see('About us');
    }

}