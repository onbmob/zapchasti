<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Личный кабинет: Пользователь';
$this->params['breadcrumbs'][] = $this->title;

$Supliers_model = new \app\modules\admin\models\SupliersModel();
$Supliers[$model->supl_id] = $Supliers_model->getFullID($model->supl_id);
$Supliers = ArrayHelper::map($Supliers, 'id', 'supl_name');

?>
<div class="popular-category-form">

    <?php     $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);  ?>

    <?= $form->field($model, 'user_code')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <?= $form->field($model, 'user_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'login')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'supl_id')->dropDownList($Supliers) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::className(), [
        'mask' => '+7(999) 999-99-99',
    ]); ?>

    <?= $form->field($model, 'pwdNew')->passwordInput(); ?>

    <?= $form->field($model, 'pwdRepeat')->passwordInput(['maxlength' => true]); ?>

    <?php ActiveForm::end(); ?>

</div>

