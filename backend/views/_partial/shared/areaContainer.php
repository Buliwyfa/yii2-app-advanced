<?php
$containerClass = 'box box-default';
$type = (isset($type) ? $type : null);

if ($type == 'error') {
	$containerClass = 'box box-danger';
} else if ($type == 'report') {
    $containerClass = 'box box-default box-report';
}
?>
<div class="<?= $containerClass ?>">
	<div class="box-body">
        <?= (isset($content) ? $content : null) ?>
	</div>
</div>