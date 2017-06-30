<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/**
 * @var $model app\modules\admin\models\ClientModel
 */
?>
<div class="popular-category-form">
    <?php     $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);  ?>
    <?= $form->field($model, 'user_code')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'user_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'login')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'role')->dropDownList(['user'=>'Пользователь','admin'=>'Администратор']) ?>
    <?= $form->field($model, 'activity')->dropDownList(['y'=>'Да','n'=>'Нет']) ?>
    <?/*= $form->field($model, 'columns')->textInput(['maxlength' => true])  */?><!--
    --><?/*= $form->field($model, 'hide_art')->checkbox()  */?>
    <?= $form->field($model, 'pwdNew')->passwordInput(); ?>
    <?= $form->field($model, 'pwdRepeat')->passwordInput(['maxlength' => true]); ?>
<!--    <br>
    <?/*= Html::label('Аватар') */?>
    <br>
    <?/*= $form->field($model, 'images')->fileInput(['accept'=>'image/png', 'onchange'=>'loadFile(event, "output1")'])->label(false) */?>
    <img id="output1" alt="" src="/img/avatar/?id=<?/*= $model->id */?>&t=<?/*= time() */?>" width="65">
    <br>
    <?/*= Html::label('Рекомендуемый размер фото 65 х 85') */?>
    <br><br><br>
-->
    <?= $form->field($model, 'chmail')->checkbox(); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton('Сбросить',['class' => 'btn btn-default']) ?>
        <?= Html::a('Выход', 'index.php?r=admin',['class' => 'btn btn-success']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
