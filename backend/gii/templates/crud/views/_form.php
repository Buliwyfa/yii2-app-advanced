<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

/* @var $model \yii\db\ActiveRecord */
$model = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model <?php echo ltrim($generator->modelClass, '\\') ?> */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $areaTitle string */

?>

<?php echo "<?php " ?>$this->beginContent('@backend/views/_partial/shared/areaContainer.php'); ?>

	<?php echo "<?php " ?>$form = ActiveForm::begin(); ?>

	<?php echo "<?php echo " ?>$form->errorSummary($model); ?>

<?php foreach ($generator->getColumnNames() as $attribute) {
    if (in_array($attribute, $safeAttributes)) {
        echo "    <?php echo " . $generator->generateActiveField($attribute) . " ?>\n\n";
    }
} ?>
	<div class="box-footer">
        <?php echo "<?php echo " ?>Html::submitButton($model->isNewRecord
		? Yii::t('backend', 'Button.Create', ['modelClass' => $areaTitle])
		: Yii::t('backend', 'Button.Update', ['modelClass' => $areaTitle]), ['class' => 'btn btn-success']) ?>

		<?php echo "<?php echo " ?>Html::a(Yii::t('backend', 'Button.Back', ['modelClass' => $areaTitle]),
		['index'], ['class' => 'btn btn-primary']); ?>
	</div>

    <?php echo "<?php " ?>ActiveForm::end(); ?>

<?php echo "<?php " ?>$this->endContent(); ?>