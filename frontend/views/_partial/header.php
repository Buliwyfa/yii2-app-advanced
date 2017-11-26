<?php

/* @var $this \yii\web\View */

use common\models\domain\Language;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\helpers\Url;

NavBar::begin([
    'brandLabel' => Yii::$app->name,
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-inverse navbar-fixed-top',
    ],
]);

$menuItems = [
    ['label' => Yii::t('frontend', 'Site.Menu.Home'), 'url' => ['/site/index']]
];

// links
$linksSubItems = [
    ['label' => Yii::t('frontend', 'Site.Menu.AboutUs'), 'url' => ['/about-us']],
    ['label' => Yii::t('frontend', 'Site.Menu.TermsOfUse'), 'url' => ['/terms-of-use']],
    ['label' => Yii::t('frontend', 'Site.Menu.PrivacyPolicy'), 'url' => ['/privacy-policy']],
    ['label' => Yii::t('frontend', 'Site.Menu.GalleryList'), 'url' => ['/gallery/list']],
    ['label' => Yii::t('frontend', 'Site.Menu.Contact'), 'url' => ['/contact']],
];

$menuItems[] = [
    'label' => Yii::t('frontend', 'Site.Menu.Links'),
    'url' => '#',
    'options' => ['class' => 'treeview'],
    'items' => $linksSubItems,
];

// languages
$languagesSubItems = [];

$languages = Language::find()->orderBy('name')->all();

foreach ($languages as $language) {
    $languagesSubItems[] = [
        'label' => $language->native_name,
        'url' => 'javascript: Language.change(' . $language->id . ')',
        'icon' => Url::to('@web/images/flags/' . $language->code_iso_language . '.png'),
    ];
}

$menuItems[] = [
    'label' => Yii::t('frontend', 'Site.Menu.Language'),
    'url' => '#',
    'options' => ['class' => 'treeview'],
    'items' => $languagesSubItems,
    'encodeLabels' => false,
];

// other menus
if (Yii::$app->user->isGuest) {
    $menuItems[] = ['label' => Yii::t('frontend', 'Site.Menu.Signup'), 'url' => ['/customer/signup']];
    $menuItems[] = ['label' => Yii::t('frontend', 'Site.Menu.Login'), 'url' => ['/customer/login']];
} else {
    $menuItems[] = '<li>'
        . Html::beginForm(['/customer/logout'], 'post')
        . Html::submitButton(
            Yii::t('frontend', 'Site.Menu.Logout', ['name' => Yii::$app->user->identity->getPublicIdentity()]),
            ['class' => 'btn btn-link logout']
        )
        . Html::endForm()
        . '</li>';
}

echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => $menuItems,
]);

NavBar::end();