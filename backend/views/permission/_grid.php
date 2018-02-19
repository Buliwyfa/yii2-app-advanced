<?php

use common\components\grid\EnumColumn;
use common\models\domain\Permission;
use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $showGridViewFilter boolean */
/* @var $filterModel \yii\db\ActiveRecord */

echo GridView::widget([
	'options' => [
		'class' => 'grid-view table-responsive'
	],
	'dataProvider' => $dataProvider,
	'filterModel' => ($showGridViewFilter ? $filterModel : null),
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'id',
        [
            'attribute' => 'description',
            'value' => function ($model) {
                return Yii::t('backend', $model->description);
            }
        ],
        'action',
        [
            'attribute' => 'action_group',
            'value' => function ($model) {
                return Yii::t('backend', $model->action_group);
            }
        ],
        [
            'class' => EnumColumn::class,
            'attribute' => 'status',
            'enum' => Permission::getStatusList(),
        ],
        'created_at:datetime',
	    [
	        'class' => 'yii\grid\ActionColumn',
	        'template' => '<div class="action-column">{view}</div>',
	    ],
		[
            'class' => 'yii\grid\ActionColumn',
            'template' => '<div class="action-column">{update}</div>',
        ],
		[
			'class' => 'yii\grid\ActionColumn',
			'template' => '<div class="action-column">{delete}</div>',
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
