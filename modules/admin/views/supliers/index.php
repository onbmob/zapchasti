<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var $model = new app\modules\loger\models\auchlog;
 * @var $dataProviderModel yii\data\ActiveDataProvider;
 */

$this->title = 'Просмотр поставщиков';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="popular-category-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><?= Html::a('Добавить поставщика', ['create'], ['class' => 'btn btn-success']) ?></p>

    <?= GridView::widget([
        'dataProvider' => $dataProviderModel,
        'filterModel' => $model,
        'columns' => [
            'supl_name',
            'user_name',
            'login',
            'email',
            'role',
            'activity',
            ['class' => 'yii\grid\ActionColumn', 'headerOptions' => ['width' => '70'],],

        ],
    ]); ?>

</div>