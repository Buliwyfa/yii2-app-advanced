<?php

namespace frontend\tests\unit\models;

use common\models\domain\Customer;
use frontend\fixtures\CustomerFixture;
use frontend\models\form\PasswordResetRequestForm;
use frontend\tests\UnitTester;
use Yii;

class PasswordResetRequestFormTest extends \Codeception\Test\Unit
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

    public function testSendMessageWithWrongEmailAddress()
    {
        $model = new PasswordResetRequestForm();
        $model->email = 'not-existing-email@example.com';
        expect_not($model->sendEmail());
    }

    public function testNotSendEmailsToInactiveUser()
    {
        $user = $this->tester->grabFixture('customer', 1);
        $model = new PasswordResetRequestForm();
        $model->email = $user['email'];
        expect_not($model->sendEmail());
    }

    public function testSendEmailSuccessfully()
    {
        $userFixture = $this->tester->grabFixture('customer', 0);

        $model = new PasswordResetRequestForm();
        $model->email = $userFixture['email'];
        $user = Customer::findOne(['password_reset_token' => $userFixture['password_reset_token']]);

        expect_that($model->sendEmail());
        expect_that($user->password_reset_token);

        $emailMessage = $this->tester->grabLastSentEmail();
        expect('valid email is sent', $emailMessage)->isInstanceOf('yii\mail\MessageInterface');
        expect($emailMessage->getTo())->hasKey($model->email);
        expect($emailMessage->getFrom())->hasKey(Yii::$app->params['supportEmail']);
    }

}
