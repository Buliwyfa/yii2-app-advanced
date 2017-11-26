<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = $name;
?>

<div class="site-index" style="text-align: center;">
    <h1>
        <?= Yii::$app->name ?>
    </h1>

    <br />
    <br />

    <?= Html::img('@web/images/logo.png', ['class' => 'img-responsive', 'style' => 'max-width: 200px; margin: 0 auto;']) ?>
</div>