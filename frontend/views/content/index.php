<?php

/* @var $this yii\web\View */
/* @var $content Content */

$this->title = $content->title;
$this->params['breadcrumbs'][] = $this->title;

use common\models\domain\Content; ?>
<div class="content-index">

    <h1><?= $content->title ?></h1>

    <?= $content->content ?>

</div>
