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
        'brandLabel' => 'На главную',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Пользователи', 'url' => ['/admin/client']],
            ['label' => 'Поставщики', 'url' => ['/admin/supliers']],
            [
                'label' => 'Настройки сайта',
                'url' => ['#'],
                'items' => [
                    ['label' => 'Статические страницы', 'url' => ['/admin/pages-manager']],
                    ['label' => 'Меню ст.страниц', 'url' => ['/admin/category-search']],
                    ['label' => 'Авто на главной', 'url' => ['/admin/cars']],
                ],
            ],
            [
                'label' => 'Настройки',
                'url' => ['#'],
                'items' => [
                    ['label' => 'Регионы', 'url' => ['/admin/region']],
                    ['label' => 'Настройки БД Кроссов', 'url' => ['/admin/cross-db']],
                    ['label' => 'Настройки почты', 'url' => ['/admin/mail-setting']],
                    ['label' => 'Управление адресами', 'url' => ['/admin/mail-setting/group-index']],
                    ['label' => '----------------------',],
                    ['label' => 'Обновить легковые авто', 'url' => ['/admin/ajax/load-car','type'=> '1']],
                    ['label' => 'Обновить грузовые авто', 'url' => ['/admin/ajax/load-car','type'=> '2']],
                    ['label' => 'Обновить мтоциклы', 'url' => ['/admin/ajax/load-car','type'=> '4']],
                    ['label' => 'Обновить запчасти', 'url' => ['/admin/ajax/load-car','type'=> '0']],
                    ['label' => '----------------------',],
                    ['label' => 'Удалить запчасти', 'url' => ['/admin/ajax/delete-load-car','type'=> '0']],
                    ['label' => 'Удалить мотоциклы', 'url' => ['/admin/ajax/delete-load-car','type'=> '4']],
                ],
            ],
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
