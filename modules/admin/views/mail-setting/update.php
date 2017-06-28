<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\MailAdressModel; */

$this->title = 'Редактирование получателя:';
$this->params['breadcrumbs'][] = ['label' => 'Получатели Email', 'url' => ['group-index']];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="popular-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('form', [
        'model' => $model,
    ]) ?>
    <?= Html::a('Выход', 'index',['class' => 'btn btn-success']); ?>

</div>
