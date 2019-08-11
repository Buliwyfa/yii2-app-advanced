<?php

namespace frontend\tests\unit\models;

use common\models\domain\Customer;
use frontend\fixtures\CustomerFixture;
use frontend\models\form\SignupForm;
use frontend\tests\UnitTester;
use Yii;

class SignupFormTest extends \Codeception\Test\Unit
{

    /**
     * @var UnitTester
     */
    protected $tester;

    public function _before()
    {
        Yii::$app->language = 'en';

        $this->tester->haveFixtures([
            'customer' => [
                'class' => CustomerFixture::class,
                'dataFile' => codecept_data_dir() . 'customer.php'
            ]
        ]);
    }

    public function testCorrectSignup()
    {
        $model = new SignupForm([
            'email' => 'new-customer-2@test.com',
            'password' => '123mudar',
            'languageId' => 1,
        ]);

        $customer = $model->signup();
        expect($customer)->notNull();

        /** @var Customer $customer */
        $customer = $this->tester->grabRecord('common\models\domain\Customer', [
            'email' => 'new-customer-2@test.com',
            'status' => Customer::STATUS_ACTIVE
        ]);

        expect($customer)->notNull();
    }

    public function testNotCorrectSignup()
    {
        $model = new SignupForm([
            'email' => 'paulo@prsolucoes.com',
            'password' => '123mudar',
            'languageId' => 1,
        ]);

        expect_not($model->signup());
        expect_that($model->getErrors('email'));

        expect($model->getFirstError('email'))
            ->equals('This email address has already been taken.');
    }

}
