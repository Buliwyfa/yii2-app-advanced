<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\form\ContactForm */

use yii\helpers\Html;

$this->title = Yii::t('frontend', 'Contact.Success.Title');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-success">
    <h1><?= Html::encode($this->title) ?></h1>

    <p style="text-align: center;">
        <?= Html::img('@web/images/ico-success.png', ['style' => 'width: 128px;']) ?>
        <br/>
        <br/>
        <?= Yii::t('frontend', 'Contact.Success.Message') ?>
    </p>

</div>
