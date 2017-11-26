<?php
/**
 * @var $this yii\web\View
 * @var $content string
 */

use backend\assets\BackendAsset;
use yii\bootstrap\Alert;
use yii\helpers\ArrayHelper;
use yii\widgets\Breadcrumbs;

$bundle = BackendAsset::register($this);
?>
<?php $this->beginContent('@backend/views/layouts/base.php'); ?>
<div class="wrapper">

	<!-- Header logo -->
	<header class="main-header">
		<a href="<?= Yii::$app->urlManager->createAbsoluteUrl('/') ?>" class="logo">
	        <span class="logo-mini">
		        <img src="<?= Yii::getAlias('@web/images/sidemar-mini-logo.png') ?>"/>
	        </span>
			<span class="logo-lg">
		        <?= Yii::$app->name ?>
	        </span>
		</a>

		<!-- Header - Nav bar -->
        <?= $this->render('../_partial/header') ?>
	</header>

	<!-- Left side column - Side menu -->
    <?= $this->render('../_partial/sideMenu') ?>

	<!-- Right side column - Content -->
	<aside class="content-wrapper">

		<!-- Header content  -->
		<section class="content-header">
			<h1>
                <?= $this->title ?>
                <?php if (isset($this->params['subtitle'])): ?>
					<small><?= $this->params['subtitle'] ?></small>
                <?php endif; ?>
			</h1>

            <?= Breadcrumbs::widget([
                'tag' => 'ol',
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
		</section>

		<!-- Main content -->
		<section class="content">
            <?php if (Yii::$app->session->hasFlash('flash')): ?>
                <?= Alert::widget([
                    'body' => ArrayHelper::getValue(Yii::$app->session->getFlash('flash'), 'body'),
                    'options' => ArrayHelper::getValue(Yii::$app->session->getFlash('flash'), 'options'),
                ]) ?>
            <?php endif; ?>
            <?= $content ?>
		</section>

	</aside>
</div>

<?php $this->endContent(); ?>
