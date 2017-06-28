<?php
use app\assets\AdminAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */
array_unshift($this->params['breadcrumbs'], ['label' => 'Управление', 'url' => ['/admin']]);
AdminAsset::register($this);
$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <?= Html::csrfMetaTags() ?>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= 'Управление' ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Главная',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Пользователи', 'url' => ['/admin/client']],
            ['label' => 'Оповещение', 'url' => ['/admin/alarm']],
            [
                'label' => 'Настройки сайта',
                'url' => ['#'],
                'items' => [
                    ['label' => 'Баннеры', 'url' => ['/admin/banner']],
                    ['label' => 'Разделы', 'url' => ['/admin/quick-search']],
                    ['label' => 'Категории', 'url' => ['/admin/category']],
                    ['label' => 'Статические страницы', 'url' => ['/admin/pages-manager']],
                    //['label' => 'Категории товаров', 'url' => ['/admin/category-auto']],
                    //['label' => 'Производители', 'url' => ['/admin/suppliers']],
                    ['label' => 'Категории(стр. поиска)', 'url' => ['/admin/category-search']],
                    ['label' => 'Производители(стр. поиска)', 'url' => ['/admin/suppliers-search']],
                    ['label' => 'Техномир', 'url' => ['/admin/tehnomir']],
                    ['label' => 'Пустые запросы', 'url' => ['/admin/log-null-search']],
                ],
            ],
            [
                'label' => 'Каталоги',
                'url' => ['#'],
                'items' => [
                    ['label' => '==TecDoc==', 'url' => '#',
                        'options' => ['class' => 'list-group-item list-group-item-info'],
                    ],
//                    ['label' => 'Марки', 'url' => ['/admin/mark']],
                    ['label' => 'Марки авто', 'url' => ['/admin/car-brand']],
                ],
            ],
            [
                'label' => 'Почта, телефон',
                'url' => ['#'],
                'items' => [
                    ['label' => 'Настройки почты', 'url' => ['/admin/mail-setting']],
                    ['label' => 'Управление адресами', 'url' => ['/admin/mail-setting/group-index']],
                    ['label' => 'Телефоны менеджеров', 'url' => ['/admin/phone']],
                ],
            ],

            ['label' => 'Отзывы', 'url' => ['/admin/reviews']],
/*
            [
                'label' => 'Отзывы',
                'url' => ['#'],
                'items' => [
                    ['label' => 'Модерирование', 'url' => ['/admin/reviews']],
                    ['label' => 'Test Social', 'url' => ['/admin/social']],
                ],
            ],
*/
            ['label' => 'Админка прайсов', 'url' => ['/admin_price/web']],
        ],

    ]);

    NavBar::end();
    ?>
    <div class="container main">
        <div class="row">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>
</div>
<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Nirax <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
