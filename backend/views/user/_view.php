<?php

use common\models\domain\Group;
use common\models\domain\User;
use yii\bootstrap\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\domain\User */

?>

<div class="nav-tabs-custom">

    <ul class="nav nav-tabs">
        <li class="active">
            <a href="#tab_1" data-toggle="tab"><?= Yii::t('backend', 'User.Area.TabData') ?></a>
        </li>
        <li>
            <a href="#tab_2" data-toggle="tab"><?= Yii::t('backend', 'User.Area.TabGroups') ?></a>
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
                    'username',
                    'email:email',
                    [
                        'attribute' => 'gender',
                        'value' => function ($model, $widget) {
                            $list = User::getGenderList();

                            if (isset($list[$model->gender])) {
                                return $list[$model->gender];
                            }

                            return null;
                        }
                    ],
                    [
                        'label' => Yii::t('backend', 'Label.Language'),
                        'attribute' => 'language.name',
                    ],
                    [
                        'attribute' => 'root',
                        'value' => function ($model, $widget) {
                            $list = User::getRootList();

                            if (isset($list[$model->root])) {
                                return $list[$model->root];
                            }

                            return null;
                        }
                    ],
                    [
                        'attribute' => 'status',
                        'value' => function ($model, $widget) {
                            $list = User::getStatusList();

                            if (isset($list[$model->status])) {
                                return $list[$model->status];
                            }

                            return null;
                        }
                    ],
                    'logged_at:datetime',
                    'created_at:datetime',
                    'updated_at:datetime',
                    [
                        'attribute' => 'avatar_path',
                        'format' => 'raw',
                        'value' => function ($model, $widget) {
                            return Html::img($model->getAvatar('@web/images/profile-default.png'), [
                                'class' => 'img-responsive',
                            ]);
                        }
                    ],
                ],
            ]) ?>
        </div>

        <div class="tab-pane" id="tab_2">
            <?php
            $groups = Group::find()->orderByName()->all();

            if ($groups) {
                foreach ($groups as $group) {
                    echo $this->render('_groupView', ['group' => $group, 'model' => $model]);
                }
            }
            ?>
        </div>
    </div>
</div>