<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $customer common\models\domain\Customer */
/* @var $body string */
?>
<div class="contact">
	<h1>New message from contact form</h1>

    <?php if ($customer) { ?>
		<h3>Logged sender data:</h3>

		<p>Name: <?= $customer->getFullName() ?></p>
		<p>E-mail: <?= $customer->email ?></p>
    <?php } ?>

    <h3>Form data:</h3>

    <p>Name: <?= $name ?></p>
    <p>E-mail: <?= $email ?></p>

	<h3>Message:</h3>

	<p><?= nl2br(Html::encode($body)) ?></p>
</div>
