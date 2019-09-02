<?php
/**
 * @var $this yii\web\View
 */

use yii\helpers\Html;

?>
<nav class="navbar navbar-static-top" role="navigation">

	<!-- Sidebar toggle button-->
	<a id="sidebar-toggle-button" href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
		<span class="sr-only"><?= Yii::t('backend', 'SideBarMenu.ToggleButton') ?></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	</a>
	<div class="navbar-custom-menu">
		<ul class="nav navbar-nav">
			<!-- User account -->
			<li class="dropdown user user-menu">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<img src="<?= Yii::$app->user->getIdentity()->getAvatar(Yii::getAlias('@web/images/profile-default.png')) ?>" class="user-image">
					<span>
						<?= Yii::$app->user->identity->username ?>
						<i class="caret"></i>
					</span>
				</a>

				<ul class="dropdown-menu">
					<!-- User image -->
					<li class="user-header light-blue">
						<img src="<?= Yii::$app->user->getIdentity()->getAvatar(Yii::getAlias('@web/images/profile-default.png')) ?>" class="img-circle"/>
						<p>
                            <?= Yii::$app->user->identity->username ?>
							<small>
                                <?= Yii::t('backend', 'SideBarMenu.UserPanel.MemberSince', Yii::$app->user->identity->created_at) ?>
							</small>
						</p>
					</li>

					<!-- Menu footer-->
					<li class="user-footer">
						<div class="pull-left">
							<?php
							if (Yii::$app->user->can('profile.index')) {
                                echo Html::a(Yii::t('backend', 'NavBarMenu.Profile'), ['/profile/index'], ['class' => 'btn btn-default btn-flat']);
							}
							?>
						</div>
						<div class="pull-right">
                            <?= Html::a(Yii::t('backend', 'NavBarMenu.Logout'), ['/site/logout'], ['class' => 'btn btn-default btn-flat', 'data-method' => 'post']) ?>
						</div>
					</li>
				</ul>
			</li>
			<li>
                <?= Html::a('<i class="fa fa-cogs"></i>', ['/settings/index']) ?>
			</li>
		</ul>
	</div>

</nav>