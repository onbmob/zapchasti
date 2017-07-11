<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $model app\modules\admin\models\ClientModel */

$this->params['breadcrumbs'][] = ['label' => 'Поставщики', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->supl_name;

$region = new \app\modules\admin\models\RegionModel();

?>
<div class="cars-category-view">

    <h1><?= Html::encode('Поставщик : '.$model->supl_name) ?></h1>

    <p>
        <?= Html::a('Выход', 'index.php?r=admin/supliers',['class' => 'btn btn-success']); ?>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить '. $model->supl_name .' ?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'supl_name',
            'supl_code',
            'login',
            'role',
            'activity',
            'user_name',
            [
                'attribute' => 'region',
                'format' => 'raw',
                'value'=> $region->getID($model->region)
            ],
            'email',
            'phone',
            'skype',
            'icq',
//            'activate_hash',
//            'columns',
//            'hide_art',
            'service',
            'town',
            'courier_base',
            'receiver_name',
            'receiver_phone',
//            [
//                'label' => 'Аватар',
//                'format' => 'image',
//                'value'=> '/img/avatar/?id=' . $model->id .'&t='.time(),
//            ],

        ],
    ]) ?>

</div>
