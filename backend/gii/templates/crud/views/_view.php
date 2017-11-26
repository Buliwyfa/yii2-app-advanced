<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model <?php echo ltrim($generator->modelClass, '\\') ?> */

?>
<?php echo "<?php " ?>$this->beginContent('@backend/views/_partial/shared/areaContainer.php'); ?>

    <p>
        <?php echo "<?php echo " ?>Html::a(Yii::t('backend', 'Button.Create', ['modelClass' => $areaTitle]), ['create'], ['class' => 'btn btn-success']) ?>
        <?php echo "<?php echo " ?>Html::a(Yii::t('backend', 'Button.Update', ['modelClass' => $areaTitle]), ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?php echo "<?php echo " ?>Html::a(Yii::t('backend', 'Button.Delete', ['modelClass' => $areaTitle]), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
			    'confirm' => Yii::t('backend', 'Message.DeleteConfirm'),
			    'method' => 'post',
            ],
        ]) ?>
        <?php echo "<?php echo " ?>Html::a(Yii::t('backend', 'Button.Back', ['modelClass' => $areaTitle]), ['index'], ['class' => 'btn btn-primary']); ?>
    </p>

    <?php echo "<?php echo " ?>DetailView::widget([
        'model' => $model,
	        'attributes' => [
<?php
if (($tableSchema = $generator->getTableSchema()) === false) {
    foreach ($generator->getColumnNames() as $name) {
        echo "                '" . $name . "',\n";
    }
} else {
    foreach ($generator->getTableSchema()->columns as $column) {
        $format = $generator->generateColumnFormat($column);
        echo "                '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
    }
}
?>
            ],
    ]) ?>

<?php echo "<?php " ?>echo($this->endContent()); ?>