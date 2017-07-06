<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $model app\modules\admin\models\ClientModel */

$this->params['breadcrumbs'][] = ['label' => 'Авто', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->Description;

$region = new \app\modules\admin\models\RegionModel();

?>
<div class="cars-category-view">

    <h1><?= Html::encode('Авто : '.$model->Description) ?></h1>

    <p>
        <?= Html::a('Выход', 'index.php?r=admin/cars',['class' => 'btn btn-success']); ?>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить '. $model->Description .' ?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'CarId',
            'Description',
            'synonium',
            [
                'attribute' => 'visible',
                'format' => 'boolean',
                'filter' => [0 => 'Нет', 1 => 'Да'],
            ],
            [
                'attribute' => 'SupplerID',
                'format' => 'boolean',
                'filter' => [0 => 'Нет', 1 => 'Да'],
            ],
            [
                'attribute' => 'CanBeDisplayed',
                'format' => 'boolean',
                'filter' => [0 => 'Нет', 1 => 'Да'],
            ],
            [
                'attribute' => 'IsPassengerCar',
                'format' => 'boolean',
                'filter' => [0 => 'Нет', 1 => 'Да'],
            ],
            [
                'attribute' => 'IsCommercialVehicle',
                'format' => 'boolean',
                'filter' => [0 => 'Нет', 1 => 'Да'],
            ],
            [
                'attribute' => 'IsMotorbike',
                'format' => 'boolean',
                'filter' => [0 => 'Нет', 1 => 'Да'],
            ],
            [
                'attribute' => 'IsEngine',
                'format' => 'boolean',
                'filter' => [0 => 'Нет', 1 => 'Да'],
            ],
            [
                'attribute' => 'IsAxle',
                'format' => 'boolean',
                'filter' => [0 => 'Нет', 1 => 'Да'],
            ],
        ],
    ]) ?>

</div>
