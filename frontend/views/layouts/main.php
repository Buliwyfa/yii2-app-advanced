<?php

/* @var $this \yii\web\View */

/* @var $content string */

use common\widgets\Alert;
use frontend\assets\FrontendAsset;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

FrontendAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode(empty($this->title) ? Yii::$app->name : $this->title) ?></title>
    <?php $this->head() ?>

    <link rel="shortcut icon" type="image/ico" href="/favicon.ico"/>
    <link rel="icon" type="image/png" href="/favicon.png" sizes="1024x1024"/>

    <script type="text/javascript">
        var frontendBaseURL = '<?= Yii::$app->request->baseUrl ?>';
    </script>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?= $this->render('/_partial/header.php') ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>

        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<?= $this->render('/_partial/footer.php') ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
