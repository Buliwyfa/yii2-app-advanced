<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model ResetPasswordForm */

use frontend\models\form\ResetPasswordForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = Yii::t('frontend', 'ResetPassword.Title');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-reset-password">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Yii::t('frontend', 'ResetPassword.TitleHint') ?>
    </p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

            <?= $form->field($model, 'password')->passwordInput(['autofocus' => true]) ?>

            <div class="form-group">
                <?= Html::submitButton(Yii::t('frontend', 'ResetPassword.ButtonSave'), ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
