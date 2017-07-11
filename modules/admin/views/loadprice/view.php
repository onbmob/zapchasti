<?php
use app\modules\admin\models\FilesModel;
use app\modules\admin\models\LoadpriceModel;
use app\modules\admin\models\SupliersModel;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;


/* @var $model app\modules\admin\models\ClientModel */

$this->params['breadcrumbs'][] = ['label' => 'Шаблон', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->descript;

$region = new \app\modules\admin\models\RegionModel();
$supl = new SupliersModel();

$price_col = LoadpriceModel::getColums();

?>
<div class="cars-category-view">

    <h1><?= Html::encode('Шаблон : '.$model->descript) ?></h1>

    <p>
        <?= Html::a('Выход', 'index.php?r=admin/loadprice',['class' => 'btn btn-success']); ?>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить '. $model->supliers .' ?',
                'method' => 'post',
            ],

        ]) ?>

        <?php echo  Html::Button('Загрузить прайс',
            ['class' => 'btn btn-primary', 'style' => 'float: right', 'onclick'=>"$('#start_search_files_basket').click()"]) ?>
        <div hidden>
        <?php
        $accept = 'application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
        $model_file = new FilesModel();
        $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'],
            'action'=>"index.php?r=admin/loadprice/load-price-from-file",'id'=> 'form_price' ]);
        echo $form->field($model, 'id')->textInput();
        echo $form->field($model_file, 'file')->fileInput(['accept'=>$accept,'class' => '', 'onchange'=>'LoadPriceFromFile(event)','id'=>'start_search_files_basket'])->label(false);
        ActiveForm::end();
        ?>
        </div>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'supliers',
                'format' => 'raw',
                'value'=> $supl->getID($model->supliers)
            ],
            'descript',
            'type',
            // ОПТИМИЗИРОВАТЬ !!!!!!!
            [
                'attribute' => 'col_0', 'format' => 'raw', 'label' => '0 колонка прайса',
                'value'=> $price_col[$model->col_0]
            ],
            [
                'attribute' => 'col_1', 'format' => 'raw', 'label' => '1 колонка прайса',
                'value'=> $price_col[$model->col_1]
            ],
            [
                'attribute' => 'col_2', 'format' => 'raw', 'label' => '2 колонка прайса',
                'value'=> $price_col[$model->col_2]
            ],
            [
                'attribute' => 'col_3', 'format' => 'raw', 'label' => '3 колонка прайса',
                'value'=> $price_col[$model->col_3]
            ],
            [
                'attribute' => 'col_4', 'format' => 'raw', 'label' => '4 колонка прайса',
                'value'=> $price_col[$model->col_4]
            ],
            [
                'attribute' => 'col_5', 'format' => 'raw', 'label' => '5 колонка прайса',
                'value'=> $price_col[$model->col_5]
            ],
            [
                'attribute' => 'col_6', 'format' => 'raw', 'label' => '6 колонка прайса',
                'value'=> $price_col[$model->col_6]
            ],
            [
                'attribute' => 'col_7', 'format' => 'raw', 'label' => '7 колонка прайса',
                'value'=> $price_col[$model->col_7]
            ],
            [
                'attribute' => 'col_8', 'format' => 'raw', 'label' => '8 колонка прайса',
                'value'=> $price_col[$model->col_8]
            ],
            [
                'attribute' => 'col_9', 'format' => 'raw', 'label' => '9 колонка прайса',
                'value'=> $price_col[$model->col_9]
            ],
            [
                'attribute' => 'col_10', 'format' => 'raw', 'label' => '10 колонка прайса',
                'value'=> $price_col[$model->col_10]
            ],
            [
                'attribute' => 'col_11', 'format' => 'raw', 'label' => '11 колонка прайса',
                'value'=> $price_col[$model->col_11]
            ],
        ],
    ]) ?>

</div>
