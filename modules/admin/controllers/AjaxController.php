<?php

namespace app\modules\admin\controllers;

use app\models\BaseService;
use app\models\CrossDb;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;

/**
 * StaticPagesController implements the CRUD actions for StaticPages model.
 */
class AjaxController extends Controller
{
    public $base;

    public function init(){
        parent::init();
        $this->base = new BaseService();
    }

    function actionLoadCar(){

        $params = Yii::$app->request->get();
        $all_brand = CrossDb::getManufacturers($params['type']);
        //echo '<pre>'; var_dump($all_brand); die;
        if(isset($all_brand['data'])){
            foreach($all_brand['data'] as $item){
                if((int)$item['SupplerID'] > 0) $item['SupplerID'] = '1';

                $item['Description'] = preg_replace("/([^\w\s]|_)/u", "", $item['Description']);
                $synonium = preg_replace("/([^\w]|_)/u", "", $item['Description']);

                $sql = "INSERT INTO cars(
                       CarId,
                       Description,
                       synonium,
                       SupplerID,
                       IsPassengerCar,
                       IsCommercialVehicle,
                       IsMotorbike,
                       IsEngine,
                       IsAxle
                       )
                    VALUES(
                    '" . $item['ID'] . "',
                    '" . $item['Description'] . "',
                    '" . $synonium . "',
                    '" . $item['SupplerID'] . "',
                    '" . $item['IsPassengerCar'] . "',
                    '" . $item['IsCommercialVehicle'] . "',
                    '" . $item['IsMotorbike'] . "',
                    '" . $item['IsEngine'] . "',
                    '" . $item['IsAxle'] . "')
                    ON DUPLICATE KEY UPDATE
                    Description = '" . $item['Description'] . "',
                    SupplerID = '" . $item['SupplerID'] . "',
                    IsPassengerCar = '" . $item['IsPassengerCar'] . "',
                    IsCommercialVehicle = '" . $item['IsCommercialVehicle'] . "',
                    IsMotorbike = '" . $item['IsMotorbike'] . "',
                    IsEngine = '" . $item['IsEngine'] . "',
                    IsAxle = '" . $item['IsAxle'] . "',
                    version = version + 1;";

                $res = Yii::$app->db->createCommand($sql)->execute();
            }
        }

        return $this->redirect($_SERVER['HTTP_REFERER']); //

    }

    function actionDeleteLoadCar(){
        $mas = [
            '0' => 'SupplerID',//запчастей, по умолчанию;
            '1' => 'IsPassengerCar',//легковых авто
            '2' => 'IsCommercialVehicle',//грузовых авто
            '3' => 'IsEngine',//двигателей
            '4' => 'IsMotorbike',//мотоциклов
            '5' => 'IsAxle',//осей
        ];

        $params = Yii::$app->request->get();

        $sql = "DELETE FROM cars
                WHERE " . $mas[$params['type']] . "=1;";
//echo '<pre>'.$sql; die;
        $return = Yii::$app->db->createCommand($sql)->execute();

        return $this->redirect($_SERVER['HTTP_REFERER']); //

    }

}
