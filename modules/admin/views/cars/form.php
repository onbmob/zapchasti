<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/**
 * @var $model app\modules\admin\models\ClientModel
 */
?>
<div class="popular-category-form">
    <?php
        $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);
    ?>

    <?= $form->field($model, 'CarId')->textInput() ?>

    <?= $form->field($model, 'Description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'synonium')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SupplerID')->checkbox(); ?>
    <?= $form->field($model, 'CanBeDisplayed')->checkbox(); ?>
    <?= $form->field($model, 'IsPassengerCar')->checkbox(); ?>
    <?= $form->field($model, 'IsCommercialVehicle')->checkbox(); ?>
    <?= $form->field($model, 'IsMotorbike')->checkbox(); ?>
    <?= $form->field($model, 'IsEngine')->checkbox(); ?>
    <?= $form->field($model, 'IsAxle')->checkbox(); ?>

    <?= $form->field($model, 'visible')->dropDownList(['1'=>'Да','0'=>'Нет']) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton('Сбросить',['class' => 'btn btn-default']) ?>
        <?= Html::a('Выход', 'index.php?r=admin/cars',['class' => 'btn btn-success']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
