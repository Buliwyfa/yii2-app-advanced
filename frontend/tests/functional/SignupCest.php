<?php

namespace frontend\tests\functional;

use common\models\domain\Customer;
use frontend\tests\FunctionalTester;
use Yii;

class SignupCest
{

    protected $formId = '#form-signup';

    public function _before(FunctionalTester $I)
    {
        Yii::$app->language = 'en';
        $I->amOnRoute('customer/signup');
    }

    public function signupWithEmptyFields(FunctionalTester $I)
    {
        $I->see('Signup', 'h1');
        $I->see('Please fill out the following fields to signup:');
        $I->submitForm($this->formId, []);
        $I->seeValidationError('Language cannot be blank.');
        $I->seeValidationError('Email cannot be blank.');
        $I->seeValidationError('Password cannot be blank.');

    }

    public function signupWithWrongEmail(FunctionalTester $I)
    {
        $I->submitForm(
            $this->formId, [
                'SignupForm[language_id]' => '1',
                'SignupForm[email]' => 'xxx',
                'SignupForm[password]' => 'xxx',
            ]
        );
        $I->dontSee('Username cannot be blank.', '.help-block');
        $I->dontSee('Password cannot be blank.', '.help-block');
        $I->see('Email is not a valid email address.', '.help-block');
    }

    public function signupSuccessfully(FunctionalTester $I)
    {
        $I->submitForm($this->formId, [
            'SignupForm[languageId]' => '1',
            'SignupForm[email]' => 'new-customer-1@test.com',
            'SignupForm[password]' => '123mudar',
        ]);

        $I->seeRecord('common\models\domain\Customer', [
            'email' => 'new-customer-1@test.com',
            'status' => Customer::STATUS_ACTIVE
        ]);
    }

}
