<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\loger\models\UserIPModel */

$this->title = 'Создание записи пользователя: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'IP Пользователей', 'url' => ['users']];
$this->params['breadcrumbs'][] = 'Создание';
?>

<div class="popular-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('form', [
        'model' => $model,
    ]) ?>

</div>
