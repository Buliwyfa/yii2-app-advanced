<?php

/* @var $this yii\web\View */
/* @var $title string */
/* @var $areaTitle string */
/* @var $viewPath string */
/* @var $containerClass string */
/* @var $breadcrumbs array */
/* @var $model \yii\db\ActiveRecord */
/* @var $filterModel \yii\db\ActiveRecord */
/* @var $dataProvider \yii\data\ActiveDataProvider */

$this->title = $title;

foreach ($breadcrumbs as $breadcrumb) {
    $this->params['breadcrumbs'][] = $breadcrumb;
}
?>

<div class="<?= $containerClass ?>-index">
    <?= $this->render($viewPath . '/_report', ['dataProvider' => $dataProvider, 'model' => $model, 'filterModel' => $filterModel, 'areaTitle' => $areaTitle, 'title' => $title]) ?>
</div>

