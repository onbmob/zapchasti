<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var $model = new app\modules\loger\models\auchlog;
 * @var $dataProviderModel yii\data\ActiveDataProvider;
 */

$this->title = 'Просмотр Авто';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="popular-category-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><?= Html::a('Добавить авто', ['create'], ['class' => 'btn btn-success']) ?></p>

    <?= GridView::widget([
        'dataProvider' => $dataProviderModel,
        'filterModel' => $model,
        'columns' => [
            'CarId',
            'Description',
            'synonium',
            [
                'attribute' => 'IsPassengerCar',
                'format' => 'raw',
                'filter' => [1 => 'Да',0 => 'Нет'],
                'headerOptions' => ['width' => '50'],
                'value' => function($model){
                    return  Html::checkbox('', $model->IsPassengerCar, ['disabled' => true]);
                }
            ],
            [
                'attribute' => 'IsCommercialVehicle',
                'format' => 'raw',
                'filter' => [1 => 'Да',0 => 'Нет'],
                'headerOptions' => ['width' => '50'],
                'value' => function($model){
                    return  Html::checkbox('', $model->IsCommercialVehicle, ['disabled' => true]);
                }
            ],
            [
                'attribute' => 'visible',
                'format' => 'raw',
                'filter' => [1 => 'Да',0 => 'Нет'],
                'headerOptions' => ['width' => '50'],
                'value' => function($model){
                    return  Html::checkbox('', $model->visible, ['disabled' => true]);
                }
            ],
            ['class' => 'yii\grid\ActionColumn', 'headerOptions' => ['width' => '70'],],

        ],
    ]); ?>

</div>