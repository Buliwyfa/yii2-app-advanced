<?php

use common\models\domain\Content;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\domain\Content */

?>
<?php $this->beginContent('@backend/views/_partial/shared/areaContainer.php'); ?>

    <p>
        <?= Html::a(Yii::t('backend', 'Button.Create', ['modelClass' => $areaTitle]), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('backend', 'Button.Update', ['modelClass' => $areaTitle]), ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('backend', 'Button.Delete', ['modelClass' => $areaTitle]), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('backend', 'Message.DeleteConfirm'),
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a(Yii::t('backend', 'Button.Back', ['modelClass' => $areaTitle]), ['index'], ['class' => 'btn btn-primary']); ?>
    </p>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'title',
        [
            'attribute' => 'tag',
            'value' => function ($model, $widget) {
                $list = Content::getTagList();

                if (isset($list[$model->tag])) {
                    return $list[$model->tag];
                }

                return null;
            }
        ],
        'content:raw',
        [
            'label' => Yii::t('backend', 'Label.Language'),
            'attribute' => 'language.name',
        ],
        [
            'attribute' => 'status',
            'value' => function ($model, $widget) {
                $list = Content::getStatusList();

                if (isset($list[$model->status])) {
                    return $list[$model->status];
                }

                return null;
            }
        ],
        'created_at:datetime',
        'updated_at:datetime',
    ],
]) ?>

<?= $this->endContent() ?>