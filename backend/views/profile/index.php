<?php

/* @var $this yii\web\View */

/* @var $model common\models\domain\User */

use common\models\domain\User;
use trntv\filekit\widget\Upload;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

$areaTitle = Yii::t('backend', 'Profile.Area.Title');

$this->title = $areaTitle;
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="profile-index">
    <?php $this->beginContent('@backend/views/_partial/shared/areaContainer.php'); ?>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'avatar')->widget(Upload::class, [
        'url' => ['avatar-upload']
    ]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'gender')->dropDownlist([
        User::GENDER_MALE => Yii::t('common', 'Gender.Male'),
        User::GENDER_FEMALE => Yii::t('common', 'Gender.Female'),
    ], [
        'prompt' => Yii::t('backend', 'DropDown.Empty'),
    ]);
    ?>

    <hr/>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'repeat_password')->passwordInput(['maxlength' => 30]) ?>

    <div class="box-footer">
        <?= Html::submitButton(Yii::t('backend', 'Profile.Index.ConfirmButton'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?php $this->endContent(); ?>
</div>