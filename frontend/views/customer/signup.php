<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\form\SignupForm */

use common\models\domain\Language;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = Yii::t('frontend', 'Signup.Title');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Yii::t('frontend', 'Signup.TitleHint') ?>
    </p>

    <div class="row">
        <div class="col-md-6 col-xs-12">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'languageId')->dropDownList(ArrayHelper::map(Language::find()->all(), 'id', 'name'), ['prompt' => '', 'autofocus' => true]) ?>

                <?= $form->field($model, 'firstName')->textInput() ?>

                <?= $form->field($model, 'lastName')->textInput() ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('frontend', 'SignupForm.ButtonConfirm'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>

        <div class="col-md-6 col-xs-12">
            <p>
                <?= Yii::t('frontend', 'SignupForm.AlreadyRegisteredHint') ?>
            </p>

            <a class="btn btn-primary" href="<?= Url::to('/customer/login') ?>">
                <?= Yii::t('frontend', 'SignupForm.ButtonLogin') ?>
            </a>
        </div>
    </div>
</div>
