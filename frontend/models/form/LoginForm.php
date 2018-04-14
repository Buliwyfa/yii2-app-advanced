<?php

namespace frontend\models\form;

use common\models\domain\Customer;
use Yii;
use yii\base\Model;

class LoginForm extends Model
{

    public $email;
    public $password;
    public $rememberMe = true;

    private $_user;

    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, Yii::t('common', 'LoginForm.ErrorIncorrectUsernamePassword'));
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'email' => Yii::t('common', 'LoginForm.Email'),
            'password' => Yii::t('common', 'LoginForm.Password'),
            'rememberMe' => Yii::t('common', 'LoginForm.RememberMe'),
        ];
    }

    /**
     * Finds user (customer) by [[email]]
     *
     * @return Customer|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = Customer::findByEmail($this->email);
        }

        return $this->_user;
    }

}
