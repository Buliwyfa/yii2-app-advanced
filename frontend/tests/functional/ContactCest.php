<?php

namespace frontend\tests\functional;

use Codeception\Scenario;
use frontend\tests\FunctionalTester;
use Yii;

/* @var $scenario Scenario */
class ContactCest
{

    public function _before(FunctionalTester $I)
    {
        Yii::$app->language = 'en';
        $I->amOnPage('contact');
    }

    public function checkContact(FunctionalTester $I)
    {
        $I->see('Contact', 'h1');
    }

    public function checkContactSubmitNoData(FunctionalTester $I)
    {
        $I->submitForm('#contact-form', []);
        $I->see('Contact', 'h1');
        $I->seeValidationError('Name cannot be blank');
        $I->seeValidationError('Email cannot be blank');
        $I->seeValidationError('Message cannot be blank');
        $I->seeValidationError('The verification code is incorrect');
    }

    public function checkContactSubmitNotCorrectEmail(FunctionalTester $I)
    {
        $I->submitForm('#contact-form', [
            'ContactForm[name]' => 'tester',
            'ContactForm[email]' => 'tester.email',
            'ContactForm[subject]' => 'test subject',
            'ContactForm[body]' => 'test content',
            'ContactForm[verifyCode]' => 'testme',
        ]);
        $I->seeValidationError('Email is not a valid email address.');
        $I->dontSeeValidationError('Name cannot be blank');
        $I->dontSeeValidationError('Subject cannot be blank');
        $I->dontSeeValidationError('Body cannot be blank');
        $I->dontSeeValidationError('The verification code is incorrect');
    }

    public function checkContactSubmitCorrectData(FunctionalTester $I)
    {
        $I->submitForm('#contact-form', [
            'ContactForm[name]' => 'tester',
            'ContactForm[email]' => 'tester@example.com',
            'ContactForm[subject]' => 'test subject',
            'ContactForm[body]' => 'test content',
            'ContactForm[verifyCode]' => 'testme',
        ]);
        $I->seeEmailIsSent();
        $I->see('You message was sent with success.');
    }

}
