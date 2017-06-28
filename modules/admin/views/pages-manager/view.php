<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\StaticPages */

$this->title = 'Страница: '. $model->Title;
$this->params['breadcrumbs'][] = ['label' => 'Статические страницы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="static-pages-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Выйти', 'index',['class' => 'btn btn-success']); ?>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить данную страницу?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Title',
            [
                'attribute' => 'url',
                'format' => 'raw',
                'value'=> Html::a($model->Title,'/'.$model->url)
            ],
//            'topMenu:boolean',
            'keywords:ntext',
            'description:ntext',
            [
                'attribute' => 'content',
                'format' => 'html'
            ],
//            'position',
        ],
    ]) ?>

</div>