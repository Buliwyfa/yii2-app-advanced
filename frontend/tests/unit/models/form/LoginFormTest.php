<?php

namespace frontend\tests\unit\models;

use common\tests\UnitTester;
use frontend\fixtures\CustomerFixture;
use frontend\models\form\LoginForm;
use Yii;

/**
 * Login form test
 */
class LoginFormTest extends \Codeception\Test\Unit
{

    /**
     * @var UnitTester
     */
    protected $tester;

    /**
     * @return array
     */
    public function _fixtures()
    {
        return [
            'customer' => [
                'class' => CustomerFixture::class,
                'dataFile' => codecept_data_dir() . 'customer.php'
            ]
        ];
    }

    public function _before()
    {
        Yii::$app->language = 'en';
    }

    public function testLoginNoUser()
    {
        $model = new LoginForm([
            'email' => 'not_existing_email',
            'password' => 'not_existing_password',
        ]);

        expect('model should not login user', $model->login())->false();
        expect('user should not be logged in', Yii::$app->user->isGuest)->true();
    }

    public function testLoginWrongPassword()
    {
        $model = new LoginForm([
            'email' => 'paulo@prsolucoes.com',
            'password' => 'wrong-password',
        ]);

        expect('model should not login user', $model->login())->false();
        expect('error message should be set', $model->errors)->hasKey('password');
        expect('user should not be logged in', Yii::$app->user->isGuest)->true();
    }

    public function testLoginCorrect()
    {
        $model = new LoginForm([
            'email' => 'paulo@prsolucoes.com',
            'password' => 'customer@password',
        ]);

        expect('model should login user', $model->login())->true();
        expect('error message should not be set', $model->errors)->hasntKey('password');
        expect('user should be logged in', Yii::$app->user->isGuest)->false();
    }
}
