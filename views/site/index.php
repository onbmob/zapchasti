<?php

$this->title = 'Главная страница';
//echo '<pre>'; var_dump($brands); die;
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <div class="col-lg-3">
                <h3>Легковые авто</h3>
                <?php
                foreach($brands['IsPassengerCar'] as $item) {
                    if(is_file('../web/img/brand/IsPassengerCar/'.$item->synonium.'.png'))
                          $photo = 'img/brand/IsPassengerCar/'.$item->synonium.'.png';
                    else $photo = 'img/brand/IsPassengerCar/auto_icon.png';
                    $Description = $item->Description;
                    if($item->SupplerID == 1) $Description .= ' / запчасти';
                    if($item->IsEngine  == 1) $Description .= ' / двигатели';
                    ?>
                    <div style="margin: 8px">
                        <img width="30" src="<?= $photo ?>" alt="">
                       <span  style="margin-left: 10px">
                           <a href="/index.php?r=search/default/get-models-manufacturer&id=<?=$item->CarId?>&brand=<?=$item->Description?>">
                               <?= $Description ?>
                           </a>
                       </span>
                    </div>
                <?php } ?>
                <p><a class="btn btn-default" href="/index.php?r=search/default/search-type-brand&type=1">
                        Показать все &raquo;
                </a></p>
            </div>
            <div class="col-lg-3">
                <h3>Грузовые авто</h3>
                <?php
                foreach($brands['IsCommercialVehicle'] as $item) {
                    if(is_file('../web/img/brand/IsPassengerCar/'.$item->synonium.'.png'))
                        $photo = 'img/brand/IsPassengerCar/'.$item->synonium.'.png';
                    else $photo = 'img/brand/IsPassengerCar/auto_icon.png';
                    $Description = $item->Description;
                    if($item->SupplerID == 1) $Description .= ' / запчасти';
                    if($item->IsEngine  == 1) $Description .= ' / двигатели';
                    ?>
                    <div style="margin: 8px">
                        <img width="30" src="<?= $photo ?>" alt="">
                       <span  style="margin-left: 10px">
                           <a href="/index.php?r=search/default/get-models-manufacturer&id=<?=$item->CarId?>&brand=<?=$item->Description?>">
                               <?= $Description ?>
                           </a>
                       </span>
                    </div>
                <?php } ?>
                <p><a class="btn btn-default" href="/index.php?r=search/default/search-type-brand&type=2">
                        Показать все &raquo;
                    </a></p>
            </div>
            <div class="col-lg-3">
                <h3>Мотоциклы</h3>
                <?php
                $no_photo = 'img/brand/IsMotorbike/bike.ico';
                foreach($brands['IsMotorbike'] as $item) {
                    $Description = $item->Description;
                    if($item->SupplerID == 1) $Description .= ' / запчасти';
                    if($item->IsEngine  == 1) $Description .= ' / двигатели';
                    ?>
                    <div style="margin: 8px">
                        <img width="30" src="<?= $photo ?>" alt="">
                       <span  style="margin-left: 10px">
                           <a href="/index.php?r=search/default/get-models-manufacturer&id=<?=$item->CarId?>&brand=<?=$item->Description?>">
                               <?= $Description ?>
                           </a>
                       </span>
                    </div>
                <?php } ?>
                <p><a class="btn btn-default" href="/index.php?r=search/default/search-type-brand&type=4">
                        Показать все &raquo;
                    </a></p>
            </div>
            <div class="col-lg-3">
                <h3>Запчасти</h3>
                <?php
                $no_photo = 'img/brand/SupplerID/zp.ico';
                foreach($brands['SupplerID'] as $item) {
                    $Description = $item->Description;
                    if($item->SupplerID == 1) $Description .= ' / запчасти';
                    if($item->IsEngine  == 1) $Description .= ' / двигатели';
                    ?>
                    <div style="margin: 8px">
                        <img width="30" src="<?= $photo ?>" alt="">
                       <span  style="margin-left: 10px">
                           <a href="/index.php?r=search/default/get-models-manufacturer&id=<?=$item->CarId?>&brand=<?=$item->Description?>">
                               <?= $Description ?>
                           </a>
                       </span>
                    </div>
                <?php } ?>
                <p><a class="btn btn-default" href="/index.php?r=search/default/search-type-brand&type=0">
                        Показать все &raquo;
                    </a></p>
            </div>
        </div>

    </div>
</div>
