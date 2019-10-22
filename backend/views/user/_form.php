<?php

use common\helpers\SimpleArrayHelper;
use common\models\domain\Group;
use common\models\domain\Language;
use common\models\domain\User;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\domain\User */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $areaTitle string */

?>

<?php $form = ActiveForm::begin(); ?>

    <div class="nav-tabs-custom">

        <?= $form->errorSummary($model); ?>

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
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'status')->dropDownList(SimpleArrayHelper::map(User::getStatusList())) ?>

                <?= $form->field($model, 'gender')->dropDownList(SimpleArrayHelper::map(User::getGenderList()), ['prompt' => '']) ?>

                <?= $form->field($model, 'language_id')->dropDownList(ArrayHelper::map(Language::find()->all(), 'id', 'name'), ['prompt' => '']) ?>

                <?= $form->field($model, 'root')->dropDownList(SimpleArrayHelper::map(User::getRootList()), ['prompt' => '']) ?>

                <hr/>

                <?= $form->field($model, 'password')->passwordInput(['maxlength' => true, 'value' => '']) ?>

                <?= $form->field($model, 'repeat_password')->passwordInput(['maxlength' => true, 'value' => '']) ?>
            </div>

            <div class="tab-pane" id="tab_2">
                <?php
                $groups = Group::find()->orderByName()->all();

                if ($groups) {
                    foreach ($groups as $group) {
                        echo $this->render('_groupForm', ['group' => $group, 'model' => $model, 'form' => $form]);
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