<?php

use app\modules\admin\models\SupliersModel;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\SearchStaticPages */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Статические страницы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="static-pages-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать статическую страницу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'Title',
            [
                'attribute' => 'supliers',
                'format' => 'raw',
                'value'=> function($searchModel){
                       $supl = new SupliersModel();
                        return $supl->getID($searchModel->supliers);
                    }
            ],
            'url',
//            [
//                'attribute' => 'url',
//                'format' => 'raw',
//                'value'=> function($searchModel){
//                    return Html::a($searchModel->Title,'/'.$searchModel->url);
//                }
//            ],

//            'beforeContent:ntext',
//            'content:ntext',
            // 'afterContent:ntext',
            // 'keywords:ntext',
            // 'description:ntext',
            // 'topMenu',
            // 'position',

//            ['class' => 'yii\grid\ActionColumn'],

            ['class' => 'yii\grid\ActionColumn',
//            'headerOptions' => ['width' => '30'],
                'template' => '{view}{update}{delete}',
            ],



        ],
    ]); ?>

</div>
