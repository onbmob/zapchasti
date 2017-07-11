<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\ClientModel*/

$this->title = 'Редактирование шаблона : ' . $model->descript;
$this->params['breadcrumbs'][] = ['label' => 'Шаблон', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->descript, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="popular-category-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('form', [
        'model' => $model,
    ]) ?>
</div>
