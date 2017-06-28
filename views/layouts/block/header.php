<?php
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

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
        ['label' => 'Регистрация', 'url' => ['/site/authoriz']],
        Yii::$app->user->isGuest ? (
        ['label' => 'Вход', 'url' => ['/site/login']]
        ) : (
            '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Выход (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>'
        )
    ],
]);
NavBar::end();


