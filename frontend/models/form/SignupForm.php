<?php

namespace frontend\models\form;

use common\models\domain\Customer;
use Yii;
use yii\base\Model;

/**
 * Signup form
 */
class SignupForm extends Model
{

    public $firstName;
    public $lastName;
    public $email;
    public $password;
    public $languageId;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['languageId', 'integer'],
            ['languageId', 'required'],

            [['firstName', 'lastName'], 'string', 'max' => 50],

            ['email', 'validateOnlyAllowedEmail'],
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\domain\Customer', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'firstName' => Yii::t('frontend', 'SignupForm.FirstName'),
            'lastName' => Yii::t('frontend', 'SignupForm.LastName'),
            'email' => Yii::t('frontend', 'SignupForm.Email'),
            'password' => Yii::t('frontend', 'SignupForm.Password'),
            'languageId' => Yii::t('frontend', 'SignupForm.LanguageId'),
        ];
    }

    /**
     * Signs user up.
     *
     * @return Customer|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $customer = new Customer();
        $customer->first_name = $this->firstName;
        $customer->last_name = $this->lastName;
        $customer->email = $this->email;
        $customer->language_id = $this->languageId;

        $customer->setPassword($this->password);
        $customer->generateAuthKey();

        return $customer->save() ? $customer : null;
    }

    public function validateOnlyAllowedEmail($attribute, $params, $validator)
    {
        $email = $this->$attribute;
        $valid = false;
        $allowedDomains = ['modec', 'sofec'];

        foreach ($allowedDomains as $domain) {
            if (strpos($email, '@' . $domain) > -1) {
                $valid = true;
            }
        }

        if (!$valid) {
            $this->addError($attribute, 'Your email need be @modec or @sofec.');
        }
    }

}
