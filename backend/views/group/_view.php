<?php

use common\models\domain\Group;
use common\models\domain\Permission;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\domain\Group */

?>

<div class="nav-tabs-custom">

	<ul class="nav nav-tabs">
		<li class="active">
			<a href="#tab_1" data-toggle="tab"><?= Yii::t('backend', 'Group.Area.TabData') ?></a>
		</li>
		<li>
			<a href="#tab_2" data-toggle="tab"><?= Yii::t('backend', 'Group.Area.TabPermissions') ?></a>
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
                    [
                        'attribute' => 'name',
                        'value' => function ($model, $widget) {
            	            return Yii::t('backend', $model->name);
                        }
                    ],
                    [
                        'attribute' => 'status',
                        'value' => function ($model, $widget) {
                            $list = Group::getStatusList();

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
		</div>

		<div class="tab-pane" id="tab_2">
            <?php
            $permissions = Permission::find()->orderByActionGroupAndAction()->all();
            $lastActionGroup = '';
            $isFirstActionGroup = true;


            if ($permissions) {
                foreach ($permissions as $permission) {
                    if ($lastActionGroup != $permission['action_group']) {
                        $lastActionGroup = $permission['action_group'];

                        if ($isFirstActionGroup) {
                            $isFirstActionGroup = false;
                        } else {
                            echo '<hr />';
                        }

                        ?>

						<p>
							<h4>
	                            <?= Yii::t('backend', $permission['action_group']) ?>
							</h4>
						</p>

                        <?php
                    }

                    echo $this->render('_permissionView', ['permission' => $permission, 'model' => $model]);
                }
            }
            ?>
		</div>
	</div>
</div>