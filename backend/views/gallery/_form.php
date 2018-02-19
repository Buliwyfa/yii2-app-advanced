<?php

use common\helpers\SimpleArrayHelper;
use common\models\domain\Gallery;
use common\models\domain\Language;
use trntv\filekit\widget\Upload;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\domain\Gallery */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $areaTitle string */

?>

<?php $form = ActiveForm::begin(); ?>

<div class="nav-tabs-custom">

    <ul class="nav nav-tabs">
		<li class="active">
			<a href="#tab_1" data-toggle="tab"><?= Yii::t('backend', 'Gallery.Area.TabData') ?></a>
		</li>
		<li>
			<a href="#tab_2" data-toggle="tab"><?= Yii::t('backend', 'Gallery.Area.TabItems') ?></a>
		</li>
	</ul>

	<div class="tab-content">
		<div class="tab-pane active" id="tab_1">

            <?= $form->errorSummary($model); ?>

            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'tag')->dropDownList(SimpleArrayHelper::map(Gallery::getTagList()), ['prompt' => null]) ?>

            <?= $form->field($model, 'language_id')->dropDownList(ArrayHelper::map(Language::find()->onlyAllowedLanguage()->all(), 'id', 'name'), ['prompt' => '']) ?>

            <?= $form->field($model, 'status')->dropDownList(SimpleArrayHelper::map(Gallery::getStatusList()), ['prompt' => null]) ?>

		</div>

		<div class="tab-pane" id="tab_2">

            <?= $form->field($model, 'items')->widget(Upload::class, [
                'url' => ['item-upload'],
                'sortable' => true,
                'maxFileSize' => 50000000, // 50 MiB
	            'multiple' => true,
                'maxNumberOfFiles' => 20
            ]) ?>

		</div>

		<div class="box-footer">
            <?= Html::submitButton($model->isNewRecord
                ? Yii::t('backend', 'Button.Create', ['modelClass' => $areaTitle])
                : Yii::t('backend', 'Button.Update', ['modelClass' => $areaTitle]), ['class' => 'btn btn-success']) ?>

            <?= Html::a(Yii::t('backend', 'Button.Back', ['modelClass' => $areaTitle]),
                ['index'], ['class' => 'btn btn-primary']); ?>
		</div>
	</div>

</div>

<?php ActiveForm::end(); ?>