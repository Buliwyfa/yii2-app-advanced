<?php

use common\helpers\SimpleArrayHelper;
use common\models\domain\Gallery;
use common\models\domain\Language;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\search\GallerySearch */
/* @var $form yii\bootstrap\ActiveForm */

?>

<div class="search-filters">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'tag') ?>

    <?= $form->field($model, 'language_id')->dropDownList(ArrayHelper::map(Language::find()->onlyAllowedLanguage()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'status')->dropDownList(SimpleArrayHelper::map(Gallery::getStatusList()), ['prompt' => null]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('backend', 'Button.Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('backend', 'Button.Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
