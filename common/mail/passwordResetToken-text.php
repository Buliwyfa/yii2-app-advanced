<?php

/* @var $this yii\web\View */
/* @var $user common\models\domain\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
Hello <?= $user->getPublicIdentity() ?>,

Follow the link below to reset your password:

<?= $resetLink ?>
