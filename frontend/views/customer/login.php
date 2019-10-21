<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model LoginForm */

use frontend\models\form\LoginForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::t('frontend', 'Customer.Login.Title');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Yii::t('frontend', 'Customer.Login.TitleHint') ?>
    </p>

    <div class="row">
        <div class="col-md-6 col-xs-12">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

            <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'rememberMe')->checkbox() ?>

            <div style="color:#999;margin:1em 0">
                <?= Yii::t('frontend', 'LoginForm.ForgotPasswordHint') ?>
                <?= Html::a(Yii::t('frontend', 'LoginForm.ButtonResetPassword'), ['/customer/request-password-reset']) ?>
                .
            </div>

            <div class="form-group">
                <?= Html::submitButton(Yii::t('frontend', 'LoginForm.ButtonConfirm'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>

        <div class="col-md-6 col-xs-12">
            <p>
                <?= Yii::t('frontend', 'LoginForm.NotRegisteredHint') ?>
            </p>

            <a class="btn btn-primary" href="<?= Url::to('/customer/signup') ?>">
                <?= Yii::t('frontend', 'LoginForm.ButtonSignup') ?>
            </a>
        </div>
    </div>
</div>
