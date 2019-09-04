<?php

use common\components\grid\EnumColumn;
use common\models\domain\Gallery;
use common\models\domain\Language;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

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
        'title',
        [
            'class' => EnumColumn::class,
            'attribute' => 'tag',
            'enum' => Gallery::getTagList(),
        ],
        [
            'attribute' => 'language.name',
            'label' => Yii::t('backend', 'Label.Language'),
            'filter' => Html::activeDropDownList($filterModel, 'language_id', ArrayHelper::map(Language::find()->onlyAllowedLanguage()->asArray()->all(), 'id', 'name'), ['class' => 'form-control', 'prompt' => '']),
        ],
        [
            'class' => EnumColumn::class,
            'attribute' => 'status',
            'enum' => Gallery::getStatusList(),
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
