<?php

use common\components\grid\EnumColumn;
use common\models\domain\User;
use yii\bootstrap\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */
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
            'attribute' => 'username',
            'format' => 'raw',
            'value' => function ($model, $widget) {
                return '
                <span class="user-avatar-mini light-blue">
                    <img src="' . $model->getAvatar(Yii::getAlias('@web/images/profile-default.png')) . '" class="img-circle"/>
                    ' . $model->username . '
                </span>
                ';
            }
        ],
        'email',
        [
            'class' => EnumColumn::class,
            'attribute' => 'status',
            'enum' => User::getStatusList(),
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
    ]
]);