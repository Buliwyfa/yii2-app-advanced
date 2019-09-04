<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;
use Yii;

class AboutCest
{

    public function _before(FunctionalTester $I)
    {
        Yii::$app->language = 'en';
    }

    public function checkAbout(FunctionalTester $I)
    {
        $I->amOnRoute('about-us');
        $I->see('About us', 'h1');
    }

}
