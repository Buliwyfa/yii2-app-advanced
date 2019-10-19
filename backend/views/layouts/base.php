<?php

use backend\assets\BackendAsset;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

$bundle = BackendAsset::register($this);

$this->params['body-class'] = array_key_exists('body-class', $this->params) ? $this->params['body-class'] : null;
?>

<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>

        <link rel="shortcut icon" type="image/ico" href="/favicon.ico"/>
        <link rel="icon" type="image/png" href="/favicon.png" sizes="1024x1024"/>

        <script type="text/javascript">
            var backendBaseURL = '<?= Yii::$app->request->baseUrl ?>';
        </script>

        <!-- Google Font -->
        <link rel="stylesheet"
              href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <?php
    $adminSidebarToogleState = Yii::$app->request->cookies->get('admin-toggle-sidebar-state');
    $adminSidebarClass = ($adminSidebarToogleState == 'closed' ? 'sidebar-collapse' : '');

    echo Html::beginTag('body', [
        'class' => implode(' ', [
            ArrayHelper::getValue($this->params, 'body-class'),
            'skin-blue',
            'sidebar-mini',
            $adminSidebarClass
        ])
    ]) ?>
    <?php $this->beginBody() ?>
    <?= $content ?>
    <?php $this->endBody() ?>
    <?= Html::endTag('body') ?>
    </html>
<?php $this->endPage() ?>