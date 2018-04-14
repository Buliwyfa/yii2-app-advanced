<?php

/* @var $this yii\web\View */
/* @var $user common\models\domain\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['customer/reset-password', 'token' => $user->password_reset_token]);

echo Yii::t('common', 'Mail.PasswordResetRequest.Body.Text', [
    'name' => $user->getPublicIdentity(),
    'link' => $resetLink,
]);