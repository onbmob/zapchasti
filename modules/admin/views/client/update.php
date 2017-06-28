<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\ClientModel*/

$this->title = 'Редактирование записи пользователя: ' . $model->user_name;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="popular-category-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('form', [
        'model' => $model,
    ]) ?>
</div>
