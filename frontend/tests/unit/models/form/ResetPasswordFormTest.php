<?php

namespace frontend\tests\unit\models;

use frontend\fixtures\CustomerFixture;
use frontend\models\form\ResetPasswordForm;
use frontend\tests\UnitTester;
use Yii;

class ResetPasswordFormTest extends \Codeception\Test\Unit
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
            ],
        ]);
    }

    public function testResetWrongToken()
    {
        $this->tester->expectException('\yii\base\InvalidArgumentException', function () {
            new ResetPasswordForm('');
        });

        $this->tester->expectException('\yii\base\InvalidArgumentException', function () {
            new ResetPasswordForm('notexistingtoken_1391882543');
        });
    }

    public function testResetCorrectToken()
    {
        $customer = $this->tester->grabFixture('customer', 0);
        $form = new ResetPasswordForm($customer['password_reset_token']);
        expect_that($form->resetPassword());
    }

}
