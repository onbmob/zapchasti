<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Управление БД Кроссов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cars-category-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['edit-setting'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'host',
            'username',
            'password',
        ],
    ]) ?>

</div>
