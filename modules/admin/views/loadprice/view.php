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
        <?= Html::a('Шаблоны', 'index.php?r=admin/loadprice',['class' => 'btn btn-success']); ?>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить шаблон', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить '. $model->supliers .' ?',
                'method' => 'post',
            ],

        ]) ?>

        <?= Html::a('Удалить все записи из БД', ['delete-db', 'id' => $model->supliers], [
            'class' => 'btn btn-danger',
            'style' => 'float: right; margin-left: 5px',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить из БД все записи '. $supl->getID($model->supliers) .' ?',
                'method' => 'post',
            ],

        ]) ?>
        <?php echo  Html::Button('Загрузить прайс <b>'.$model->type.'</b>',
            ['class' => 'btn btn-primary',
             'style' => 'float: right',
             'onclick'=>"$('#start_search_files_basket').click()"
            ]) ?>

        <div hidden>
        <?php
        switch($model->type){
            case '.csv':
                $action = 'load-price-from-file-csv';
                $accept = '.csv';
                break;
            case '.xls':
            case '.xlsx':
                $action = 'load-price-from-file-csv';
                //$action = 'load-price-from-file-xls';
                //$accept = 'application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
                $accept = '.xls, .xlsx';
                break;
        }
        $model_file = new FilesModel();
        $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'],
            'action'=>"index.php?r=admin/loadprice/".$action,'id'=> 'form_price' ]);
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
                'attribute' => 'col_1', 'format' => 'raw', 'label' => '1 (A) колонка прайса',
                'value'=> $price_col[$model->col_1]
            ],
            [
                'attribute' => 'col_2', 'format' => 'raw', 'label' => '2 (B) колонка прайса',
                'value'=> $price_col[$model->col_2]
            ],
            [
                'attribute' => 'col_3', 'format' => 'raw', 'label' => '3 (C) колонка прайса',
                'value'=> $price_col[$model->col_3]
            ],
            [
                'attribute' => 'col_4', 'format' => 'raw', 'label' => '4 (D) колонка прайса',
                'value'=> $price_col[$model->col_4]
            ],
            [
                'attribute' => 'col_5', 'format' => 'raw', 'label' => '5 (E) колонка прайса',
                'value'=> $price_col[$model->col_5]
            ],
            [
                'attribute' => 'col_6', 'format' => 'raw', 'label' => '6 (F) колонка прайса',
                'value'=> $price_col[$model->col_6]
            ],
            [
                'attribute' => 'col_7', 'format' => 'raw', 'label' => '7 (G) колонка прайса',
                'value'=> $price_col[$model->col_7]
            ],
            [
                'attribute' => 'col_8', 'format' => 'raw', 'label' => '8 (H) колонка прайса',
                'value'=> $price_col[$model->col_8]
            ],
            [
                'attribute' => 'col_9', 'format' => 'raw', 'label' => '9 (I) колонка прайса',
                'value'=> $price_col[$model->col_9]
            ],
            [
                'attribute' => 'col_10', 'format' => 'raw', 'label' => '10 (J) колонка прайса',
                'value'=> $price_col[$model->col_10]
            ],
            [
                'attribute' => 'col_11', 'format' => 'raw', 'label' => '11 (K) колонка прайса',
                'value'=> $price_col[$model->col_11]
            ],
            [
                'attribute' => 'col_12', 'format' => 'raw', 'label' => '12 (L) колонка прайса',
                'value'=> $price_col[$model->col_12]
            ],
            [
                'attribute' => 'col_13', 'format' => 'raw', 'label' => '13 (M) колонка прайса',
                'value'=> $price_col[$model->col_13]
            ],
            [
                'attribute' => 'col_14', 'format' => 'raw', 'label' => '14 (N) колонка прайса',
                'value'=> $price_col[$model->col_14]
            ],
        ],
    ]) ?>

</div>
