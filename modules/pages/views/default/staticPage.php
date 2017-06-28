<?php

/* @var $this yii\web\View */
/* @var $page \app\models\StaticPages */


$this->title = $page->Title;
$this->params['breadcrumbs'][] = $page->Title;
$this->registerMetaTag([
    'name' => 'description',
    'content' => $page->description
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => $page->keywords
]);
?>
<div class="section-main">
    <div class="tabs">
        <div class="container">
            <ul class="tabs-list">
                <li><a href="/">Главная</a> /</li>
                <li><a href=""><?= $page->Title ?></a></li>
            </ul>
        </div>
    </div>
    <div class="container">
       <?= $page->content ?>
    </div>
</div>