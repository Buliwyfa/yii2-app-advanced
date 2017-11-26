<?php

use common\models\domain\Gallery;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\domain\Gallery */

?>

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
                        'label' => Yii::t('backend', 'Label.Language'),
                        'attribute' => 'language.name',
                    ],
                    [
                        'attribute' => 'status',
                        'value' => function ($model, $widget) {
                            $list = Gallery::getStatusList();

                            if (isset($list[$model->status])) {
                                return $list[$model->status];
                            }

                            return null;
                        }
                    ],
                    [
                        'attribute' => 'tag',
                        'value' => function ($model, $widget) {
                            $list = Gallery::getTagList();

                            if (isset($list[$model->tag])) {
                                return $list[$model->tag];
                            }

                            return null;
                        }
                    ],
                    'created_at:datetime',
                    'updated_at:datetime',
                ],
            ]) ?>
		</div>

		<div class="tab-pane" id="tab_2">
			<ul class="gallery-items">
	            <?php
	            $items = $model->getGalleryItems()->orderByOrder()->all();

	            if ($items) {
	                foreach ($items as $item) {
	                    echo $this->render('_itemView', ['model' => $item]);
	                }
	            }
	            ?>
			</ul>

			<div style="clear: both"></div>
		</div>
	</div>
</div>