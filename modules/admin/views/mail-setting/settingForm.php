<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var $model app\models\MailSettingModel
 */
$this->title = 'Редактирование настроек';
$this->params['breadcrumbs'][] = ['label' => 'Управление почтой', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="popular-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'class')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'host')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'port')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Сбросить',['class' => 'btn btn-default']) ?>
        <?= Html::a('Выход', 'index',['class' => 'btn btn-success']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
