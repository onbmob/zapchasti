<?php

/* @var $this yii\web\View */
use yii\bootstrap\Html;

/* @var $page \app\models\StaticPages */
$mas_type = [
    '0' => ['SupplerID','Запчасти'],//запчастей, по умолчанию;
    '1' => ['IsPassengerCar','Легковые'],//легковых авто
    '2' => ['IsCommercialVehicle','Грузовые'],//грузовых авто
    '3' => ['IsEngine','Двигатели'],//двигателей
    '4' => ['IsMotorbike','Мотоциклы'],//мотоциклов
    '5' => ['IsAxle','Производитель осей']//осей
];

$this->title = $mas_type[$type][1];
$this->params['breadcrumbs'][] = $this->title;

//echo '<pre>'; var_dump($brand); die;
?>

<div class="body-content">

    <div class="row">
        <h3><?=$mas_type[$type][1]?></h3>
        <div class="col-lg-3">
            <?php
            $kol = count($brand['data'])/4;
            $i = 0;
            $zag = '-';
            foreach($brand['data'] as $item) { $i++;
                $synonium = \app\models\BaseService::OnlyLettersAndDigits($item['Description']);
                if(is_file('../web/img/brand/'.$mas_type[$type][0].'/'.$synonium.'.png'))
                    $photo = 'img/brand/'.$mas_type[$type][0].'/'.$synonium.'.png';
                else $photo = 'img/brand/'.$mas_type[$type][0].'/no_photo.ico';
                //if($item['SupplerID'] == 1) $item['Description'] .= ' / запчасти';
                //if($item['IsEngine']  == 1) $item['Description'] .= ' / двигатели';
                ?>
                <?php if(substr($item['Description'],0,1) != $zag) { $zag = substr($item['Description'],0,1);?>
                    <div style="margin: 8px"><span style="margin-left: 10px; font-size: 16px; font-weight: bold;"><?= $zag ?></span></div>
                <?php } ?>
                <div style="margin: 8px">
                    <img width="30" src="<?= $photo ?>" alt="">
                       <span  style="margin-left: 10px">
                           <a href="/index.php?r=search/default/get-models-manufacturer&id=<?=$item['ID']?>&brand=<?=Html::encode($item['Description'])?>">
                               <?= $item['Description'] ?>
                           </a>
                       </span>
                </div>
                <?php if($i >= $kol) { $i = 0;?>
                    </div>
                    <div class="col-lg-3">
                        <div style="margin: 8px"><span style="margin-left: 10px; font-size: 16px; font-weight: bold;"><?= $zag ?></span></div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
</div>
