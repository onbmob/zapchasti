<?php

use app\modules\admin\models\SupliersModel;
use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var $model = new app\modules\loger\models\auchlog;
 * @var $dataProviderModel yii\data\ActiveDataProvider;
 */

$this->title = 'Просмотр пользователей';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="popular-category-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><?= Html::a('Добавить пользователя', ['create'], ['class' => 'btn btn-success']) ?></p>

    <?= GridView::widget([
        'dataProvider' => $dataProviderModel,
        'filterModel' => $model,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//            ['attribute'=>'activity', 'filter'=>array("y"=>"Активно","n"=>"Не активно")],

//            'id',
            'user_code',
//            ['label' => 'Код пользователя', 'format' => 'raw',
//                'value' => function($model){return '<span>'.$model['user_code'].'</span>';}],
            'user_name',
            'login',
            'email',
            [
                'attribute' => 'supl_id',
                'format' => 'raw',
                'value'=> function($model){
                    $supl = new SupliersModel();
                    return $supl->getID($model->supl_id);
                }
            ],
//            'pwd',
//            'a',
            //'columns',
            //'hide_art',
//            ['label' => 'Связь', 'format' => 'raw',
//                'value' => function($model){
//                    $result = $model->getIp();
//                    return '<span style="color: '.$result['color'].'">'.$result['name'].'</span>';
//                    return '<span style="color: red">'.$model['user_name'].'</span>';
//                }
//            ],
//            'service',
//            'town',
//            'courier_base',
//            'receiver_name',
//            'receiver_phone',
            'role',
            'activity',
//            [
//                'label' => 'Активность',
//                'format' => 'raw',
//                'value' => function ($model) {
//                    return Html::checkbox('', $model->activity==='y', ['disabled'=>true]);
//                },
//            ],
//            [
//                'label' => 'Аватар',
//                'format' => 'raw',
//                'value' => function ($model) {
//                    return Html::img('/img/avatar/?id=' . $model->id .'&t='.time(), [
//                        'alt' => 'картинка не найдена',
//                        'style' => 'max-width:65px;'
//                    ]);
//                },
//            ],

            ['class' => 'yii\grid\ActionColumn', 'headerOptions' => ['width' => '70'],],

        ],
    ]); ?>

</div>