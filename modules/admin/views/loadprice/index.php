<?php

use app\modules\admin\models\SupliersModel;
use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var $model = new app\modules\loger\models\auchlog;
 * @var $dataProviderModel yii\data\ActiveDataProvider;
 */

$this->title = 'Просмотр шаблона прайса';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="popular-category-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><?= Html::a('Добавить шаблон', ['create'], ['class' => 'btn btn-success']) ?></p>

    <?= GridView::widget([
        'dataProvider' => $dataProviderModel,
        'filterModel' => $model,
        'columns' => [
            //'supliers',
            [
                'attribute' => 'supliers',
                'format' => 'raw',
                'value'=> function($model){
                    $supl = new SupliersModel();
                    return $supl->getID($model->supliers);
                }
            ],
            'descript',
            'type',
            ['class' => 'yii\grid\ActionColumn', 'headerOptions' => ['width' => '70'],],

        ],
    ]); ?>

</div>