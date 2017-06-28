<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->email;
$this->params['breadcrumbs'][] = ['label' => 'Получатели Email', 'url' => ['group-index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cars-category-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить'. $model->email .' ?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'email',
            [
                'attribute' => 'group',
            ],
        ],
    ]) ?>

</div>
