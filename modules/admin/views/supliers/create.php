<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\ClientModel */

$this->title = 'Создание Поставщика ';
$this->params['breadcrumbs'][] = ['label' => 'Поставщик', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Создание';
?>

<div class="popular-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('form', [
        'model' => $model,
    ]) ?>

</div>
