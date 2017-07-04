<?php
use app\modules\admin\models\SupliersModel;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $model app\modules\admin\models\ClientModel */

$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->user_name;
$supl = new SupliersModel();

?>
<div class="cars-category-view">

    <h1><?= Html::encode('Пользователь : '.$model->user_name) ?></h1>

    <p>
        <?= Html::a('Выход', 'index.php?r=admin/client',['class' => 'btn btn-success']); ?>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить '. $model->user_name .' ?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'login',
//            'pwd',
            'user_code',
            'user_name',
            'email',
            [
                'attribute' => 'supl_id',
                'format' => 'raw',
                'value'=> $supl->getID($model->supl_id)
            ],
            'phone',
            'role',
            'activity',
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
