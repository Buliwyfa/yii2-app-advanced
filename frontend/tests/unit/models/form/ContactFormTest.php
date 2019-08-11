<?php

namespace frontend\tests\unit\models;

use frontend\models\form\ContactForm;
use Yii;
use yii\mail\MessageInterface;

class ContactFormTest extends \Codeception\Test\Unit
{

    public function _before()
    {
        Yii::$app->language = 'en';
    }

    public function testSendEmail()
    {
        $model = new ContactForm();

        $model->attributes = [
            'name' => 'Tester',
            'email' => 'test@test.com',
            'body' => 'body of current message',
        ];

        expect_that($model->sendEmail(Yii::$app->params['adminEmail']));

        // using Yii2 module actions to check email was sent
        $this->tester->seeEmailIsSent();

        /** @var MessageInterface $emailMessage */
        $emailMessage = $this->tester->grabLastSentEmail();

        expect('valid email is sent', $emailMessage)->isInstanceOf('yii\mail\MessageInterface');
        expect($emailMessage->getTo())->hasKey(Yii::$app->params['adminEmail']);
        expect($emailMessage->toString())->stringContainsString('body of current message');
    }

}
