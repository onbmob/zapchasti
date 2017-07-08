<?php

/* @var $this yii\web\View */

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

$this->title = 'Главная страница';
//echo '<pre>'; var_dump($search); die;
?>
<div class="site-index">

    <style>
        .btn-primary { float: right; width: 100px}
    </style>

    <div>
        <?php $form = ActiveForm::begin(['id' => 'authoriz-form']); ?>
          <?/*=$form->field($search, 'article')->textInput(['autofocus' => true])*/?>
        <input type="text" id="search_article_main" value="" class="form-control"
               style="display:inline-flex; width: 85%;"placeholder="Введите артикул"/>
          <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
        <?php ActiveForm::end(); ?>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-3">
                <h3>Легковые авто</h3>
                <?php
                foreach($IsPassengerCar as $item) {
                    if(is_file('../web/img/brand/IsPassengerCar/'.$item->synonium.'.png'))
                          $photo = 'img/brand/IsPassengerCar/'.$item->synonium.'.png';
                    else $photo = 'img/brand/IsPassengerCar/auto_icon.png';
                    if($item->SupplerID == 1) $item->Description .= ' / запчасти';
                    if($item->IsEngine  == 1) $item->Description .= ' / двигатели';
                    ?>
                    <div style="margin: 8px">
                        <img width="30" src="<?= $photo ?>" alt="">
                       <span  style="margin-left: 10px">
                           <?= $item->Description ?>
                       </span>
                    </div>
                <?php } ?>
                <p><a class="btn btn-default" href="#">Yii Extensions &raquo;</a></p>
            </div>
            <div class="col-lg-3">
                <h3>Грузовые авто</h3>
                <?php
                foreach($IsCommercialVehicle as $item) {
                    if(is_file('../web/img/brand/IsPassengerCar/'.$item->synonium.'.png'))
                        $photo = 'img/brand/IsPassengerCar/'.$item->synonium.'.png';
                    else $photo = 'img/brand/IsPassengerCar/auto_icon.png';
                    if($item->SupplerID) $item->Description .= ' / запчасти';
                    if($item->IsEngine) $item->Description .= ' / двигатели';
                    ?>
                    <div style="margin: 8px">
                        <img width="30" src="<?= $photo ?>" alt="">
                       <span  style="margin-left: 10px">
                           <?= $item->Description ?>
                       </span>
                    </div>
                <?php } ?>
                <p><a class="btn btn-default" href="#">Yii Extensions &raquo;</a></p>
            </div>
            <div class="col-lg-3">
                <h3>Мотоциклы</h3>
                <?php
                $no_photo = 'img/brand/IsMotorbike/bike.ico';
                foreach($IsMotorbike as $item) {
                    if($item->SupplerID) $item->Description .= ' / запчасти';
                    if($item->IsEngine) $item->Description .= ' / двигатели';
                    ?>
                    <div style="margin: 8px">
                        <img width="30" src="<?= $no_photo ?>" alt="">
                       <span  style="margin-left: 10px">
                           <?= $item->Description ?>
                       </span>
                    </div>
                <?php } ?>
                <p><a class="btn btn-default" href="#">Yii Extensions &raquo;</a></p>
            </div>
            <div class="col-lg-3">
                <h3>Запчасти</h3>
                <?php
                $no_photo = 'img/brand/SupplerID/zp.ico';
                foreach($SupplerID as $item) {
                    if($item->SupplerID) $item->Description .= ' / запчасти';
                    if($item->IsEngine) $item->Description .= ' / двигатели';
                    ?>
                    <div style="margin: 8px">
                        <img width="30" src="<?= $no_photo ?>" alt="">
                       <span  style="margin-left: 10px">
                           <?= $item->Description ?>
                       </span>
                    </div>
                <?php } ?>
                <p><a class="btn btn-default" href="#">Yii Extensions &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
