<?php

/* @var $this yii\web\View */
/* @var $content \common\models\domain\Content */

$this->title = $content->title;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-index">

	<h1><?= $content->title ?></h1>

    <?= $content->content ?>

</div>
