<?php

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();
$nameAttribute = $generator->getNameAttribute();

echo "<?php\n";
?>

    use yii\helpers\Html;
    use <?php echo $generator->indexWidgetType === 'grid' ? "yii\\grid\\GridView" : "yii\\widgets\\ListView" ?>;

    /* @var $this yii\web\View */
    /* @var $dataProvider yii\data\ActiveDataProvider */
    /* @var $showGridViewFilter boolean */
    /* @var $filterModel \yii\db\ActiveRecord */

<?php if ($generator->indexWidgetType === 'grid'): ?>
    echo GridView::widget([
    'options' => [
    'class' => 'grid-view table-responsive'
    ],
    'dataProvider' => $dataProvider,
    <?php echo !empty($generator->searchModelClass) ? "'filterModel' => (\$showGridViewFilter ? \$filterModel : null),\n    'columns' => [\n" : "'columns' => [\n"; ?>
    ['class' => 'yii\grid\SerialColumn'],
    <?php
    $count = 0;
    if (($tableSchema = $generator->getTableSchema()) === false) {
        foreach ($generator->getColumnNames() as $name) {
            if (++$count < 6) {
                echo "        '" . $name . "',\n";
            } else {
                echo "        // '" . $name . "',\n";
            }
        }
    } else {
        foreach ($tableSchema->columns as $column) {
            $format = $generator->generateColumnFormat($column);
            if (++$count < 6) {
                echo "        '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
            } else {
                echo "        '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
            }
        }
    }
    ?>
    [
    'class' => 'yii\grid\ActionColumn',
    'template' => '
    <div class="action-column">{view}</div>',
    ],
    [
    'class' => 'yii\grid\ActionColumn',
    'template' => '
    <div class="action-column">{update}</div>',
    ],
    [
    'class' => 'yii\grid\ActionColumn',
    'template' => '
    <div class="action-column">{delete}</div>',
    'buttons' => [
    'delete' => function ($url, $model) {
    return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete', 'id' => $model->id], [
    'class' => '',
    'data' => [
    'confirm' => Yii::t('backend', 'Message.DeleteConfirm'),
    'method' => 'post',
    ],
    ]);
    }
    ]
    ]
    ],
    ]);
<?php else: ?>
    <?php echo "echo " ?>ListView::widget([
    'dataProvider' => $dataProvider,
    'itemOptions' => ['class' => 'item'],
    'itemView' => function ($model, $key, $index, $widget) {
    return Html::a(Html::encode($model-><?php echo $nameAttribute ?>), ['view', <?php echo $urlParams ?>]);
    },
    ])
<?php endif; ?>