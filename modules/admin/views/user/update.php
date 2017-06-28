<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\loger\models\UserIPModel */

$this->title = 'Редактирование записи пользователя: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'IP Пользователей', 'url' => ['users']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="popular-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('form', [
        'model' => $model,
    ]) ?>

</div>
