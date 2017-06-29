<?php
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;

NavBar::begin([
    'brandLabel' => 'Зпчасти от NIRAX',
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-inverse navbar-fixed-top',
    ],
]);
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => [
        ['label' => 'Контакты', 'url' => ['/site/index']],
        ['label' => 'О компании', 'url' => ['/site/about']],
        ['label' => 'Contact', 'url' => ['/site/contact']],
        ['label' => 'Админка', 'url' => ['/admin']],
        ['label' => 'Регистрация', 'url' => ['/site/authoriz']],
        ($_SESSION['role'] == 'unreg') ? (
        ['label' => 'Вход', 'url' => ['/site/login']]
        ) : (
        ['label' => 'Выход', 'url' => ['/site/logout']]
        )
    ],
]);
NavBar::end();


