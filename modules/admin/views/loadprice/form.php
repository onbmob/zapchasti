<?php

use app\modules\admin\models\LoadpriceModel;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$Supliers_model = new \app\modules\admin\models\SupliersModel();
$Supliers = $Supliers_model->getAll();


usort($Supliers, function ($a, $b) {
    return (strnatcasecmp(str_replace(' ','',$a['supl_name']), str_replace(' ','',$b['supl_name'])));
});

$Supliers = ArrayHelper::map($Supliers, 'id', 'supl_name');

$type = [
    '.xls'=>'.xls',
    '.csv'=>'.csv',
    '.xlsx'=>'.xlsx'
];

$price_col = LoadpriceModel::getColums();

?>
<div class="popular-category-form">
    <?php
        $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);
    ?>

    <?= $form->field($model, 'supliers')->dropDownList($Supliers) ?>

    <?= $form->field($model, 'descript')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList($type) ?>

    <?php
      for($i=0; $i<12; $i++){
          $col = 'col_'.$i;
          echo $form->field($model, $col)->dropDownList($price_col);
      }
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton('Сбросить',['class' => 'btn btn-default']) ?>
        <?= Html::a('Выход', 'index.php?r=admin/loadprice',['class' => 'btn btn-success']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
