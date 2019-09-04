<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\form\PasswordResetRequestForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = Yii::t('frontend', 'Customer.RequestPasswordReset.Title');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-request-password-reset">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Yii::t('frontend', 'Customer.RequestPasswordReset.TitleHint') ?>
    </p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

            <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

            <div class="form-group">
                <?= Html::submitButton(Yii::t('frontend', 'RequestPasswordReset.ButtonSend'), ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
