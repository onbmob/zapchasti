<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Личный кабинет: Поставщик';
$this->params['breadcrumbs'][] = $this->title;

$regions_model = new \app\modules\admin\models\RegionModel();
$regions = $regions_model->get();

usort($regions, function ($a, $b) {
    return (strnatcasecmp(str_replace(' ','',$a->name), str_replace(' ','',$b->name)));
});

$regions = ArrayHelper::map($regions, 'id', 'name');
$mas[0] = '-'; $regions = $mas + $regions;

?>
<div class="popular-category-form">

    <?php  $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);  ?>

    <?= $form->field($model, 'supl_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'login')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'region')->dropDownList($regions) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'skype')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'icq')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pwdNew')->passwordInput(); ?>

    <?= $form->field($model, 'pwdRepeat')->passwordInput(['maxlength' => true]); ?>

    <?php ActiveForm::end(); ?>

</div>

