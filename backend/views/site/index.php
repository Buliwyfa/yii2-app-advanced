<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = \Yii::t('backend', 'Site.Index.Title');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">
    <?php $this->beginContent('@backend/views/_partial/shared/areaContainer.php'); ?>

    <?= Html::img('@web/images/logo.png', ['style' => 'max-width: 200px;']); ?>

    <?php $this->endContent(); ?>
</div>
