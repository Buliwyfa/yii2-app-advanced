<?php

namespace frontend\models\form;

use common\models\domain\Customer;
use yii\base\Exception;
use yii\base\InvalidArgumentException;
use yii\base\Model;

/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{

    /**
     * @var string
     */
    public $password;

    /**
     * @var Customer
     */
    private $_customer;


    /**
     * Creates a form model given a token.
     *
     * @param string $token
     * @param array $config name-value pairs that will be used to initialize the object properties
     * @throws InvalidArgumentException if token is empty or not valid
     */
    public function __construct($token, $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new InvalidArgumentException('Password reset token cannot be blank.');
        }

        $this->_customer = Customer::findByPasswordResetToken($token);

        if (!$this->_customer) {
            throw new InvalidArgumentException('Wrong password reset token.');
        }

        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Resets password.
     *
     * @return bool if password was reset.
     * @throws Exception
     */
    public function resetPassword()
    {
        $customer = $this->_customer;
        $customer->setPassword($this->password);
        $customer->removePasswordResetToken();

        return $customer->save(false);
    }
}
