<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var $model = new app\modules\loger\models\auchlog;
 * @var $dataProviderModel yii\data\ActiveDataProvider;
 */

$this->title = 'Получатели Email';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="popular-category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить получателя', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProviderModel,
//        'filterModel' => $model,
        'columns' => [
            'email',
            [
                'attribute' => 'group'
            ],
            ['class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['width' => '70'],],
        ],
    ]); ?>

</div>
