<?php

/* @var $this yii\web\View */
/* @var $title string */
/* @var $areaTitle string */
/* @var $viewPath string */
/* @var $containerClass string */
/* @var $showCreateButton boolean */
/* @var $breadcrumbs array */
/* @var $showFilterForm boolean */
/* @var $showGridView boolean */
/* @var $showGridViewFilter boolean */
/* @var $searchModel \yii\db\ActiveRecord */
/* @var $filterModel \yii\db\ActiveRecord */
/* @var $dataProvider \yii\data\ActiveDataProvider */

use yii\bootstrap\Html;

$this->title = $title;

foreach ($breadcrumbs as $breadcrumb) {
    $this->params['breadcrumbs'][] = $breadcrumb;
}
?>

<div class="<?= $containerClass ?>-index">
    <?php $this->beginContent('@backend/views/_partial/shared/areaContainer.php'); ?>

        <?php
        // show search filter form
        if ($showFilterForm) {
            echo $this->render($viewPath . '/_filters', ['model' => $searchModel]);
        }
        ?>

		<p>
            <?php
            // show create button
            if ($showCreateButton) {
                echo Html::a((isset($buttonCreateLabel) ? $buttonCreateLabel : Yii::t('backend', 'Button.Create', ['modelClass' => $areaTitle])), ['create'], ['class' => 'btn btn-success']);
            }
            ?>
		</p>

        <?php
        // show grid view
        if ($showGridView) {
            echo $this->render($viewPath . '/_grid', ['dataProvider' => $dataProvider, 'filterModel' => $filterModel, 'showGridViewFilter' => $showGridViewFilter]);
        };
        ?>

	<?php $this->endContent(); ?>
</div>

