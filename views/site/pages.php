<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Стат страница';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h3> Компания <?= Html::encode($supl['supl_name']) ?></h3>
    <h3> Ответственное лицо <?= Html::encode($supl['user_name']) ?></h3>
    <p>
    <h3>  <?= $page['Title'] ?></h3>
    <?= $page['content'] ?>
    </p>
</div>
