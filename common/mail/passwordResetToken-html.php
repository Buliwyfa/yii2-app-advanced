<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\domain\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['customer/reset-password', 'token' => $user->password_reset_token]);
?>
<div class="password-reset">
    <?php
    echo Yii::t('common', 'Mail.PasswordResetRequest.Body.Html', [
        'name' => Html::encode($user->getPublicIdentity()),
        'link' => Html::a(Html::encode($resetLink), $resetLink),
    ]);
    ?>
</div>
