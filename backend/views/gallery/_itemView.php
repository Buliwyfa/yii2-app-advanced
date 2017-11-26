<?php

/* @var $this yii\web\View */

use yii\bootstrap\Html;

/* @var $model \common\models\domain\GalleryItem */

?>
<li class="gallery-item">
    <?= Html::img($model->getUrl()) ?>
</li>
