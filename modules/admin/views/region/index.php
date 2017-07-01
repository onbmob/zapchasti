<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var $dataProviderModel yii\data\ActiveDataProvider;
 */

$this->title = 'Регионы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="popular-category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p><?= Html::a('Добавить регион', ['create'], ['class' => 'btn btn-success']) ?></p>

    <?= GridView::widget([
        'dataProvider' => $dataProviderModel,
//        'filterModel' => $model,
        'columns' => [
            'name',
            ['class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['width' => '30'],//'headerOptions' => ['width' => '70'],
                'template' => '{update}{delete}',//Оставила только редактировать
            ],
        ],
    ]); ?>

</div>
