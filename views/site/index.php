<?php

/* @var $this yii\web\View */

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

$this->title = 'Главная страница';
//echo '<pre>'; var_dump($search); die;
?>
<div class="site-index">

    <div>
        <?php $form = ActiveForm::begin(['id' => 'authoriz-form']); ?>
          <?/*=$form->field($search, 'article')->textInput(['autofocus' => true])*/?>
          <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
        <?php ActiveForm::end(); ?>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-3">
                <h3>Легковые авто</h3>
                <?php
                $no_photo = '/img/brand/IsPassengerCar/auto_icon.png';
                foreach($IsPassengerCar as $item) {
                    if($item->SupplerID == 1) $item->Description .= ' / запчасти';
                    if($item->IsEngine  == 1) $item->Description .= ' / двигатели';
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
                <h3>Грузовые авто</h3>
                <?php
                $no_photo = '/img/brand/IsCommercialVehicle/truck_icon.png';
                foreach($IsCommercialVehicle as $item) {
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
                <h3>Мотоциклы</h3>
                <?php
                $no_photo = '/img/brand/IsCommercialVehicle/truck_icon.png';
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
                $no_photo = '/img/brand/IsCommercialVehicle/truck_icon.png';
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
