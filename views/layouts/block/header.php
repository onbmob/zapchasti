<?php
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

//use yii\helpers\Html;
$menu_model = new \app\modules\admin\models\CategorySearchModel();
$menu = $menu_model->getPagesListKartik();


NavBar::begin([
    'brandLabel' => 'Зпчасти от NIRAX : '.$_SESSION['userName'],
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-inverse navbar-fixed-top',
    ],
]);

$tmpItem =
    [
        ['label' => 'Главная', 'url' => ['/site/index']],
//        ['label' => 'О компании', 'url' => ['/site/about']],
//        ['label' => 'Contact', 'url' => ['/site/contact']],
    ];
foreach ($menu as $item) {
    $t='&';
    $titem = [];
    foreach ($item['sections'] as $item1) {
//        $titem [] = ['label' => $item1['title'], 'url' => ['/site/pages&id='. $item1['id'].'&supl='. $item1['supliers']]];
        $titem [] = ['label' => $item1['title'], 'url' => ['/site/pages/','id'=>$item1['id'],'supl'=>$item1['supliers']]];
    }
    $tmpItem [] = [
        'label' => $item['title'],
        'url' => ['#'],
        'items' => $titem,
    ];
}


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
    if (($_SESSION['supl_id'] == 0)) {//У юзера нет поставщика
        $tmpItem [] = ['label' => 'Личный кабинет', 'url' => ['/site/cabinet']];
    } else{
        $tmpItem [] = [
            'label' => 'Личный кабинет',
            'url' => ['#'],
            'items' => [
                ['label' => 'Пользователь', 'url' => ['/site/cabinet']],
                ['label' => 'Поставщик', 'url' => ['/site/cabinet_supl'],
                ],
            ]];
    }
    $tmpItem [] = ['label' => 'Выход', 'url' => ['/site/logout']];
}


echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => $tmpItem
]);
NavBar::end();


