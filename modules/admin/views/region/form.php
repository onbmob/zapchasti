<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var $model app\modules\admin\models\MailAdressModel;
 */
?>
<div class="popular-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?/*= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::className(), [
    'mask' => '(099) 999-99-99',
    ]); */?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton('Сбросить',['class' => 'btn btn-default']) ?>
        <?= Html::a('Выход', 'index.php?r=admin/region',['class' => 'btn btn-success']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
