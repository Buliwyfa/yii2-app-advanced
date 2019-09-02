<?php
/**
 * @var $this yii\web\View
 */

use backend\widgets\Menu;
use yii\helpers\Url;

?>
<aside class="main-sidebar">
	<section class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="<?= Yii::$app->user->getIdentity()->getAvatar(Yii::getAlias('@web/images/profile-default.png')) ?>" class="img-circle"/>
			</div>
			<div class="pull-left info">
				<p>
                    <?= Yii::t('backend', 'SideBarMenu.UserPanel.Welcome', ['username' => Yii::$app->user->identity->getPublicIdentity()]) ?>
				</p>

                <?php if (Yii::$app->user->can('profile.index')) { ?>
					<a href="<?= Url::to(['/profile/index']) ?>">
						<i class="fa fa-circle text-success"></i>
                        <?= Yii::$app->formatter->asDatetime(time()) ?>
					</a>
                <?php } else { ?>
					<a href="#" onclick='return false;'>
						<i class="fa fa-circle text-success"></i>
                        <?= Yii::$app->formatter->asDatetime(time()) ?>
					</a>
                <?php } ?>
			</div>
		</div>

		<!-- Sidebar menu -->
        <?php
        $menuItems = [];

        //////////////////////////////////////////////////////////////////////
        // MENU - HOME CONTENT
        //////////////////////////////////////////////////////////////////////

        if (Yii::$app->user->can('menu.main')) {
            $subItems = [];

            if (Yii::$app->user->can('site.index')) {
                $subItems[] = [
                    'label' => Yii::t('backend', 'SideBarMenu.Item.Dashboard'),
                    'icon' => '<i class="fa fa-tachometer"></i>',
                    'url' => ['/site/index'],
                ];
            }

            if (Yii::$app->user->can('content.index')) {
                $subItems[] = [
                    'label' => Yii::t('backend', 'SideBarMenu.Item.Content'),
                    'icon' => '<i class="fa fa-cubes"></i>',
                    'url' => ['/content/index'],
                ];
            }

            if (Yii::$app->user->can('gallery.index')) {
                $subItems[] = [
                    'label' => Yii::t('backend', 'SideBarMenu.Item.Gallery'),
                    'icon' => '<i class="fa fa-picture-o"></i>',
                    'url' => ['/gallery/index'],
                ];
            }

            $menuItems[] = [
                'label' => Yii::t('backend', 'SideBarMenu.Title.Main'),
                'url' => '#',
                'icon' => '<i class="fa fa-home"></i>',
                'options' => ['class' => 'treeview'],
                'items' => $subItems,
            ];
        }

        //////////////////////////////////////////////////////////////////////
        // MENU - REPORT
        //////////////////////////////////////////////////////////////////////

        {
            $subItems = [];

            if (Yii::$app->user->can('reports.customer-report.index')) {
                $subItems[] = [
                    'label' => Yii::t('backend', 'SideBarMenu.Item.Report.CustomerReport'),
                    'icon' => '<i class="fa fa-user"></i>',
                    'url' => ['/reports/customer-report/index']
                ];
            }

            if (Yii::$app->user->can('reports.user-report.index')) {
                $subItems[] = [
                    'label' => Yii::t('backend', 'SideBarMenu.Item.Report.UserReport'),
                    'icon' => '<i class="fa fa-user"></i>',
                    'url' => ['/reports/user-report/index']
                ];
            }

            if (Yii::$app->user->can('menu.report')) {
                $menuItems[] = [
                    'label' => Yii::t('backend', 'SideBarMenu.Title.Report'),
                    'url' => '#',
                    'icon' => '<i class="fa fa-line-chart"></i>',
                    'options' => ['class' => 'treeview'],
                    'items' => $subItems,
                ];
            }
        }

        //////////////////////////////////////////////////////////////////////
        // MENU - SYSTEM
        //////////////////////////////////////////////////////////////////////

        {
            $subItems = [];

            if (Yii::$app->user->can('user.index')) {
                $subItems[] = [
                    'label' => Yii::t('backend', 'SideBarMenu.Item.Users'),
                    'icon' => '<i class="fa fa-user"></i>',
                    'url' => ['/user/index']
                ];
            }

            if (Yii::$app->user->can('group.index')) {
                $subItems[] = [
                    'label' => Yii::t('backend', 'SideBarMenu.Item.Groups'),
                    'icon' => '<i class="fa fa-users"></i>',
                    'url' => ['/group/index']
                ];
            }

            if (Yii::$app->user->can('permission.index')) {
                $subItems[] = [
                    'label' => Yii::t('backend', 'SideBarMenu.Item.Permissions'),
                    'icon' => '<i class="fa fa-tags"></i>',
                    'url' => ['/permission/index']
                ];
            }

            if (Yii::$app->user->can('profile.index')) {
                $subItems[] = [
                    'label' => Yii::t('backend', 'SideBarMenu.Item.Profile'),
                    'icon' => '<i class="fa fa-user-circle-o"></i>',
                    'url' => ['/profile/index']
                ];
            }

            if (Yii::$app->user->can('settings.index')) {
                $subItems[] = [
                    'label' => Yii::t('backend', 'SideBarMenu.Item.Settings'),
                    'icon' => '<i class="fa fa-cogs"></i>',
                    'url' => ['/settings/index']
                ];
            }

            $subItems[] = [
                'label' => Yii::t('backend', 'SideBarMenu.Item.Logout'),
                'icon' => '<i class="fa fa-sign-out"></i>',
                'url' => ['/site/logout']
            ];

            if (Yii::$app->user->can('menu.system')) {
                $menuItems[] = [
                    'label' => Yii::t('backend', 'SideBarMenu.Title.System'),
                    'url' => '#',
                    'icon' => '<i class="fa fa-cogs"></i>',
                    'options' => ['class' => 'treeview'],
                    'items' => $subItems,
                ];
            }
        }

        //////////////////////////////////////////////////////////////////////
        // CREATE MENU
        //////////////////////////////////////////////////////////////////////

        echo Menu::widget([
            'options' => ['class' => 'sidebar-menu', 'data-widget' => 'tree'],
            'linkTemplate' => '<a href="{url}">{icon}<span>{label}</span>{right-icon}{badge}</a>',
            'submenuTemplate' => "\n<ul class=\"treeview-menu\">\n{items}\n</ul>\n",
            'activateParents' => true,
            'items' => $menuItems,
        ]);
        ?>
	</section>
</aside>