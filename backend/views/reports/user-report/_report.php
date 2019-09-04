<?php

use common\components\grid\EnumColumn;
use common\models\domain\Company;
use common\models\domain\User;
use kartik\export\ExportMenu;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $showGridViewFilter boolean */
/* @var $model \yii\db\ActiveRecord */
/* @var $filterModel \yii\db\ActiveRecord */
/* @var $areaTitle string */
/* @var $title string */

$columns = [
    'id',
    'username',
    'email',
    [
        'class' => EnumColumn::class,
        'attribute' => 'status',
        'enum' => User::getStatusList(),
    ],
    'created_at:datetime',
];

$exportMenu = ExportMenu::widget([
    'dataProvider' => $dataProvider,
    'columns' => $columns,
    'showConfirmAlert' => false,
    'fontAwesome' => true,
]);

$pdfHeader = [
    'L' => [
        'content' => $title,
        'font-size' => 8,
        'color' => '#333333',
    ],
    'C' => [
        'content' => '',
        'font-size' => 16,
        'color' => '#333333',
    ],
    'R' => [
        'content' => Yii::t('kvgrid', 'Generated') . ': ' . date("D, d-M-Y g:i a T"),
        'font-size' => 8,
        'color' => '#333333',
    ],
];

$pdfFooter = [
    'L' => [
        'content' => '',
        'font-size' => 8,
        'font-style' => 'B',
        'color' => '#999999',
    ],
    'R' => [
        'content' => '[ {PAGENO} ]',
        'font-size' => 10,
        'font-style' => 'B',
        'font-family' => 'serif',
        'color' => '#333333',
    ],
    'line' => true,
];

$panelHeadingTemplate = '
<div class="pull-right">
    {export}
</div>
<div class="pull-left">
    {summary}
</div>
<h3 class="panel-title">
    {title}
</h3>
<div class="clearfix"></div>
';

$panelBeforeTemplate = '
{before}
<div class="clearfix"></div>
';

$panelFooterTemplate = '
{footer}
<div class="clearfix"></div>
';

$this->beginContent('@backend/views/_partial/shared/areaContainer.php', ['type' => 'report']);

echo GridView::widget([
    'options' => [
        'class' => 'grid-view table-responsive'
    ],
    'dataProvider' => $dataProvider,
    'filterModel' => $filterModel,
    'columns' => $columns,
    'responsive' => true,
    'striped' => true,
    'hover' => false,
    'panel' => [
        'type' => GridView::TYPE_DEFAULT,
        'beforeOptions' => [
            'class' => ''
        ],
        'afterOptions' => [
            'class' => ''
        ],
        'footerOptions' => [
            'class' => ''
        ],
    ],
    'toolbar' => [
        $exportMenu,
    ],
    'export' => [
        'fontAwesome' => true,
        'showConfirmAlert' => false,
    ],
    'exportConfig' => [
        GridView::PDF => [
            'config' => [
                'methods' => [
                    'SetHeader' => [
                        ['odd' => $pdfHeader, 'even' => $pdfHeader]
                    ],
                    'SetFooter' => [
                        ['odd' => $pdfFooter, 'even' => $pdfFooter]
                    ],
                ],
            ],
        ],
        GridView::EXCEL => [],
        GridView::CSV => [],
    ],
    'panelPrefix' => '',
    'panelHeadingTemplate' => $panelHeadingTemplate,
    'panelBeforeTemplate' => $panelBeforeTemplate,
    'panelFooterTemplate' => $panelFooterTemplate,
]);

$this->endContent();