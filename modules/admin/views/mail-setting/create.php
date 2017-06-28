<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\MailAdressModel; */

$this->title = 'Добавить получателя:';
$this->params['breadcrumbs'][] = ['label' => 'Получатели Email', 'url' => ['group-index']];
$this->params['breadcrumbs'][] = 'Добавление';
?>

<div class="popular-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('form', [
        'model' => $model,
    ]) ?>

</div>
