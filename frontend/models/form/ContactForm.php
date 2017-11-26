<?php

namespace frontend\models\form;

use Yii;
use yii\base\Model;

/**
 * Contact form
 */
class ContactForm extends Model
{

    public $name;
    public $email;
    public $subject;
    public $body;
    public $verifyCode;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'subject'], 'safe'],
            [['body'], 'required'],
            ['email', 'email'],
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'body' => Yii::t('common', 'Model.Body'),
            'verifyCode' => Yii::t('common', 'Model.VerifyCode'),
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendEmail($email)
    {
        $customer = Yii::$app->user->isGuest ? null : Yii::$app->user->getIdentity();

        return Yii::$app->mailer->compose(['html' => 'contact-html'], ['customer' => $customer, 'body' => $this->body])
            ->setTo($email)
            ->setFrom($email)
            ->setSubject(Yii::t('frontend', 'Mail.Contact.Subject'))
            ->send();
    }
}
