<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var $model app\models\MailSettingModel
 */
$this->title = 'Редактирование доступа к БД Кроссов';
$this->params['breadcrumbs'][] = ['label' => 'Управление БД Кроссов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="popular-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'host')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'password')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Выход', 'index.php?r=admin/cross-db',['class' => 'btn btn-success']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
