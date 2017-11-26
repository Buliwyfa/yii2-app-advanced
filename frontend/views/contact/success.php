<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\form\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Url;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-success">
    <h1><?= Html::encode($this->title) ?></h1>

    <p style="text-align: center;">
        <?= Html::img('@web/images/ico-success.png', ['style' => 'width: 128px;']) ?>
        <br />
        <br />
        You message was sent with success.
    </p>

</div>
