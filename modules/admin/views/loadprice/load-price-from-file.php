<?php

/* @var $this yii\web\View */
use yii\bootstrap\Html;

/* @var $page \app\models\StaticPages */

$this->title = 'Результат загрузки - '.$err_load;
$this->params['breadcrumbs'][] = $this->title;
$excel_col = [
    'A' => 'col_1',
    'B' => 'col_2',
    'C' => 'col_3',
    'D' => 'col_4',
    'E' => 'col_5',
    'F' => 'col_6',
    'G' => 'col_7',
    'H' => 'col_8',
    'I' => 'col_9',
    'J' => 'col_10',
    'K' => 'col_11',
    'L' => 'col_12',
    'M' => 'col_13',
    'N' => 'col_14',
];

?>
<div class="body-content">
    <h3>Файл: <?=$err_load?>.</h3>

    <div class="form-group">
        <?= Html::a('Шаблоны', 'index.php?r=admin/loadprice',['class' => 'btn btn-success']); ?>
    </div>

    <h4>Время работы : <?=($data_fn - $data_st)?> сек. Необработанные строки - <b><?=$count_err_str?></b> из <?=$all_position?></h4>
    <table class="table table-striped table-bordered">
        <thead>
        </thead>
        <tr>
            <th style="width: 50px;">№</th>
            <?php foreach($excel_col as $key => $item) { ?>
                <th><?=$key?></th>
            <?php } ?>
        </tr>
        <tbody>
        <?php foreach($error_mas as $item) { ?>
            <tr>
               <td><?=$item['num_str']?></td>
                <?php
                   foreach($excel_col as $key => $ttt) {
                      if(isset($item[$key])) {
                          //if(is_string($item[$key])) $item[$key] = iconv('windows-1251', 'UTF-8', $item[$key]);
                          echo '<td>'.$item[$key].'</td>';
                      }
                      else  echo '<td>-</td>';
                ?>
                <?php }?>
            </tr>
        <?php }?>
        </tbody>
    </table>
</div>
