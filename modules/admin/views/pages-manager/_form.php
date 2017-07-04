<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use vova07\imperavi\Widget;

/* @var $this yii\web\View */
/* @var $model app\models\StaticPages */
/* @var $form yii\widgets\ActiveForm */

$Supliers_model = new \app\modules\admin\models\SupliersModel();
$Supliers = $Supliers_model->getAll();


usort($Supliers, function ($a, $b) {
    return (strnatcasecmp(str_replace(' ','',$a['supl_name']), str_replace(' ','',$b['supl_name'])));
});

$Supliers = ArrayHelper::map($Supliers, 'id', 'supl_name');
$mas[0] = '-';  $Supliers = $mas + $Supliers;



?>

<div class="static-pages-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'supliers')->dropDownList($Supliers) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>



    <?php // echo $form->field($model, 'keywords')->textarea(['rows' => 6]) ?>

    <?php // echo $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'content')->widget(Widget::className(), [
        'settings' => [
            'lang' => 'ru',
            'minHeight' => 200,
            'plugins' => ['fontsize', 'fontcolor', 'imagemanager', 'table', 'fullscreen', 'video' ],
            'imageUpload' => Url::to(['/admin/default/image-upload']),
        ]
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success']) ?>
        <?= Html::a('Выйти без сохранения', 'index.php?r=admin/pages-manager',['class' => 'btn btn-success']); ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>
