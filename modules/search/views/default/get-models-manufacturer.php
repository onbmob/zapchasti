<?php

/* @var $this yii\web\View */
use yii\bootstrap\Html;

/* @var $page \app\models\StaticPages */

$this->title = 'Модель';
$this->params['breadcrumbs'][] = $this->title;
//echo '<pre>'; var_dump($models); die;
?>
<div class="body-content">
    <h3><?=$brand?></h3>
    <table class="table table-striped table-bordered">
        <thead>

        </thead>
        <tr>
            <th>Бренд</th>
            <th>Модель</th>
            <th>Начало выпуска</th>
            <th>Конец выпуска</th>
        </tr>
        <tbody>
        <?php
           foreach($models['data'] as $item) {
               if(strlen($item['ConstructionIntervalFrom']) < 4) $date_from = '?';
               else $date_from = substr($item['ConstructionIntervalFrom'],4,2).'.'.substr($item['ConstructionIntervalFrom'],0,4);
               if(strlen($item['ConstructionIntervalTo']) < 4) $date_to = '?';
               else $date_to = substr($item['ConstructionIntervalTo'],4,2).'.'.substr($item['ConstructionIntervalTo'],0,4);
               $full_decr = \app\models\BaseService::OnlyLettersAndDigits($item['FullDescription']);
               ?>
            <tr>
            <td><?=$item['ManufacturerDescription']?></td>
            <td>
                <a href="/index.php?r=search/default/get-articles-car&id=<?=$item['ID']?>&brand=<?=Html::encode($item['ManufacturerDescription'])?>&model=<?=Html::encode($item['FullDescription'])?>">
                <?=$item['FullDescription']?>
                </a>
            </td>
            <td><?=$date_from?></td>
            <td><?=$date_to?></td>
            </tr>
        <?php }?>
        </tbody>
    </table>
</div>
