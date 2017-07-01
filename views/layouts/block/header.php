<?php
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
//use yii\helpers\Html;
$menu_model = new \app\modules\admin\models\CategorySearchModel();
$menu = $menu_model->getPagesListKartik();
//echo '<pre>'; var_dump($menu); die;


NavBar::begin([
    'brandLabel' => 'Зпчасти от NIRAX',
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-inverse navbar-fixed-top',
    ],
]);

$tmpItem =
    [
        ['label' => 'Контакты', 'url' => ['/site/index']],
        ['label' => 'О компании', 'url' => ['/site/about']],
        ['label' => 'Contact', 'url' => ['/site/contact']],
    ];
if (($_SESSION['role'] == 'admin')) {
    $tmpItem [] = ['label' => 'Админка', 'url' => ['/admin']];
}
if (($_SESSION['role'] == 'unreg')) {
    $tmpItem [] = [
        'label' => 'Вход',
        'url' => ['#'],
        'items' => [
            ['label' => 'Регистрация', 'url' => ['/site/authoriz']],
            ['label' => 'Вход', 'url' => ['/site/login'],
            ],
        ]];
} else {
    $tmpItem [] = ['label' => 'Выход', 'url' => ['/site/logout']];
}


echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => $tmpItem
]);
NavBar::end();


