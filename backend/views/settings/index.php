<?php

/* @var $this yii\web\View */

use yii\bootstrap\Html;

$areaTitle = Yii::t('backend', 'Settings.Area.Title');

$this->title = $areaTitle;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="settings-index">

    <?php $this->beginContent('@backend/views/_partial/shared/areaContainer.php'); ?>

		<div class="settings-update-permissions-container">

			<h3><?= Yii::t('backend', 'Settings.Area.UpdatePermissions.Title') ?></h3>

			<p><?= Yii::t('backend', 'Settings.Area.UpdatePermissions.Message') ?></p>

	        <?= Html::a(Yii::t('backend', 'Settings.Area.UpdatePermissions.Button', ['modelClass' => $areaTitle]), ['settings/update-permissions'], [
	            'class' => 'btn btn-danger',
	            'data' => [
	                'confirm' => Yii::t('backend', 'Message.Confirm'),
	                'method' => 'post',
	            ],
	        ]) ?>

		</div>

    <?php $this->endContent(); ?>

</div>
