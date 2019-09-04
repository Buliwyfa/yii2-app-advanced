<?php
/**
 * @var $this yii\web\View
 * @var $model \backend\models\form\LoginForm
 */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = Yii::t('backend', 'Site.Login.Title');
$this->params['breadcrumbs'][] = $this->title;
$this->params['body-class'] = 'login-page';
?>
<div class="site-login">
    <div class="login-box">
        <div class="login-logo">
            <?= Html::encode($this->title) ?>
        </div>

        <div class="header"></div>

        <div class="login-box-body">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            <div class="body">
                <?= $form->field($model, 'username') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'rememberMe')->checkbox(['class' => 'simple']) ?>
            </div>
            <div class="footer">
                <?= Html::submitButton(Yii::t('backend', 'LoginForm.ButtonLogin'), [
                    'class' => 'btn btn-primary btn-flat btn-block',
                    'name' => 'login-button'
                ]) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>