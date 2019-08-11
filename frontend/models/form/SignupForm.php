<?php

namespace frontend\models\form;

use common\models\domain\Customer;
use Yii;
use yii\base\Exception;
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
    public $gender;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['languageId', 'integer'],
            ['languageId', 'required'],

            [['firstName', 'lastName'], 'string', 'max' => 50],

            ['gender', 'default', 'value' => null],
            ['gender', 'in', 'range' => [Customer::GENDER_MALE, Customer::GENDER_FEMALE]],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\domain\Customer', 'message' => Yii::t('common', 'SignupForm.ErrorEmailAlreadyUsed')],

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
            'firstName' => Yii::t('common', 'SignupForm.FirstName'),
            'lastName' => Yii::t('common', 'SignupForm.LastName'),
            'email' => Yii::t('common', 'SignupForm.Email'),
            'password' => Yii::t('common', 'SignupForm.Password'),
            'languageId' => Yii::t('common', 'SignupForm.LanguageId'),
        ];
    }

    /**
     * Signs user up.
     *
     * @return Customer|null the saved model or null if saving fails
     * @throws Exception
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
        $customer->gender = $this->gender;

        $customer->setPassword($this->password);
        $customer->generateAuthKey();

        return $customer->save() ? $customer : null;
    }

}
