<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var $model app\modules\loger\models\auchlog;
 * @var $dataProviderModel yii\data\ActiveDataProvider;
 */

$this->title = 'Посещение сайта';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="popular-category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProviderModel,
        'filterModel' => $model,
        'columns' => [
            [
                'attribute' => 'login',
                'headerOptions' => ['width' => '100'],
            ],
            'name',
            [
                'attribute' => 'ip',
                'headerOptions' => ['width' => '150'],
            ],
            [
                'attribute' => 'dt',
                'headerOptions' => ['width' => '200'],
            ],
            [
                'label' => 'Связь',
                'format' => 'raw',
                'value' => function($model){
                    $result = $model->getForIp();
                    return '<span style="color: '.$result['color'].'">'.$result['name'].'</span>';
                }
            ]
        ],
    ]); ?>

</div>
