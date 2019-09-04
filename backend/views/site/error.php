<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */

/* @var $exception Exception */

use yii\helpers\Html;

$this->context->layout = (Yii::$app->user->isGuest ? 'base' : 'main');
$this->title = $name;

$containerClass = (Yii::$app->user->isGuest ? 'site-error-layout-base' : 'site-error');
?>
<div class="<?= $containerClass ?>">
    <?php $this->beginContent('@backend/views/_partial/shared/areaContainer.php', ['type' => 'error']); ?>

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        <?= nl2br(Yii::t('backend', 'Site.Error.MessageLine1')) ?>
    </p>

    <p>
        <?= nl2br(Yii::t('backend', 'Site.Error.MessageLine2')) ?>
    </p>

    <?php $this->endContent(); ?>
</div>
