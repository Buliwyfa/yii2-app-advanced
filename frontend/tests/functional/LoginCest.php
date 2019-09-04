<?php

namespace frontend\tests\functional;

use frontend\fixtures\CustomerFixture;
use frontend\tests\FunctionalTester;
use Yii;

class LoginCest
{

    /**
     * Load fixtures before db transaction begin
     * Called in _before()
     * @return array
     * @see \Codeception\Module\Yii2::loadFixtures()
     * @see \Codeception\Module\Yii2::_before()
     */
    public function _fixtures()
    {
        return [
            'customer' => [
                'class' => CustomerFixture::class,
                'dataFile' => codecept_data_dir() . 'login.php',
            ],
        ];
    }

    public function _before(FunctionalTester $I)
    {
        Yii::$app->language = 'en';
        $I->amOnRoute('customer/login');
    }

    public function checkEmpty(FunctionalTester $I)
    {
        $I->submitForm('#login-form', $this->formParams('', ''));
        $I->seeValidationError('Email cannot be blank.');
        $I->seeValidationError('Password cannot be blank.');
    }

    protected function formParams($login, $password)
    {
        return [
            'LoginForm[email]' => $login,
            'LoginForm[password]' => $password,
        ];
    }

    public function checkWrongPassword(FunctionalTester $I)
    {
        $I->submitForm('#login-form', $this->formParams('admin', 'wrong'));
        $I->seeValidationError('Email or password is invalid.');
    }

    public function checkInactiveAccount(FunctionalTester $I)
    {
        $I->submitForm('#login-form', $this->formParams('test-inactive@test.com', 'customer@password'));
        $I->seeValidationError('Email or password is invalid.');
    }

    public function checkValidLogin(FunctionalTester $I)
    {
        $I->submitForm('#login-form', $this->formParams('paulo@prsolucoes.com', 'customer@password'));
        $I->see('Logout (Paulo Coutinho)', 'form button[type=submit]');
        $I->dontSeeLink('Login');
        $I->dontSeeLink('Signup');
    }

}
