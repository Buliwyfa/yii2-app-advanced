<?php

use common\helpers\SimpleArrayHelper;
use common\models\domain\Group;
use common\models\domain\Permission;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\domain\Group */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $areaTitle string */

?>

<?php $form = ActiveForm::begin(); ?>

	<div class="nav-tabs-custom">

        <?= $form->errorSummary($model); ?>

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
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'status')->dropDownList(SimpleArrayHelper::map(Group::getStatusList()), ['prompt' => null]) ?>
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

                        echo $this->render('_permissionForm', ['permission' => $permission, 'model' => $model, 'form' => $form]);
                    }
                }
                ?>
			</div>
		</div>

		<div class="box-footer">
            <?= Html::submitButton($model->isNewRecord
                ? Yii::t('backend', 'Button.Create', ['modelClass' => $areaTitle])
                : Yii::t('backend', 'Button.Update', ['modelClass' => $areaTitle]), ['class' => 'btn btn-success']) ?>

            <?= Html::a(Yii::t('backend', 'Button.Back', ['modelClass' => $areaTitle]),
                ['index'], ['class' => 'btn btn-primary']); ?>
		</div>
	</div>

<?php ActiveForm::end(); ?>