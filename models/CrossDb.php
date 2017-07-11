<?php

namespace app\models;

use stdClass;
use Yii;
use yii\db\ActiveRecord;
use app\modules\admin\models\CrossDbModel;

class CrossDb extends ActiveRecord
{

    public static function getRequestForCross($params)
    {

        $ch = curl_init($params['host']); // действие раз. объявили ресурс
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS , $params);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION , true);
        curl_setopt($ch, CURLOPT_MAXREDIRS , 10);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER , true);
        curl_setopt($ch, CURLOPT_TIMEOUT , 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER , 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST , 0);

       /* curl_setopt_array($ch, [ // действие два. установили опции.
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => $params,
            CURLOPT_FOLLOWLOCATION => true, // следовать перенаправлениям...
            CURLOPT_MAXREDIRS => 10, // ... но не более 10 раз
            CURLOPT_RETURNTRANSFER => true, // смешная третья опция
            CURLOPT_TIMEOUT => 10, // Сколько сек. ждать ответ сервреа (комментарий взят из вашего сообщения, порядок букв сохранен)
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_SSL_VERIFYHOST => 0
            //CURLOPT_URL => $host // вот этой строки можно избегать инициализируя сразу с адресом. но вам проще иметь ее тут.
        ]);*/

        $res = curl_exec($ch);
        $result = json_decode($res,true);
        //$result = simplexml_load_string($result); //XML


        if ($result['result'] === false) {
            /*$result['comment'] = Error number session*/
            //echo 'Error WORK remove site  : ' . curl_error($ch);
            curl_close($ch);
            $system_os = stripos($_SERVER['SystemRoot'], 'WINDOWS');
            if($system_os !== false) {
                //iconv( "utf-8", "windows-1251", $result['comment']);
                //$result['comment'] = mb_convert_encoding($result['comment'], "CP1251", "UTF-8");
            }
            $ex['mes'] = $result['comment'];
            $ex['par'] = $params;
                BaseService::SaveLogCrossDb($ex,__FUNCTION__);
            return null;
        }

        curl_close($ch);

        libxml_use_internal_errors(true);
        $error = $res;

        if (!$result) {
            //echo $params['host'] . ' ## ' . $params['action'] . '<br>';
            //echo 'Error REQUEST remove site : '  . ' ' . $error;
            libxml_clear_errors();
            $ex['mes'] = $error;
            $ex['par'] = $params;
            BaseService::SaveLogCrossDb($ex,__FUNCTION__);
            return null;
        }

        return $result;

    }

    public static function initCross()
    {
        $tm = CrossDbModel::findOne(1);

        $data['host'] = $tm['host'];
        $data['action'] = 'sessionOpen';
        $data['login'] = $tm['username'];
        $data['password'] = $tm['password'];
        $data['keySoftware'] = 'Cross';

        $result = self::getRequestForCross($data);
        $_SESSION['idSessionCross'] = $result['idSession'];

        return;
    }

    public static function sessionClose()
    {
        if($_SESSION['idSessionCross'] == '') return null;

        $tm = CrossDbModel::findOne(1);
        $data['host'] = $tm['host'];
        $data['action'] = 'sessionClose';
        $data['idSession'] = $_SESSION['idSessionCross'];

        $result = self::getRequestForCross($data);
        return $result;
    }

    public static function getManufacturers($TreeType='')
    {
/*
        Типы производителей:
        0 –запчастей, по умолчанию;
        1–легковых авто;
        2–грузовых авто;
        3–двигателей;
        4–мотоциклов;
        5–осей;
*/
        $tm = CrossDbModel::findOne(1);

        if($_SESSION['idSessionCross'] == '') self::initCross();

        $data['host'] = $tm['host'];
        $data['action'] = 'getManufacturers';
        $data['idSession'] = $_SESSION['idSessionCross'];
        if($TreeType != '') $data['TreeType'] = $TreeType;

        $result = self::getRequestForCross($data);
        return $result;

    }

    public static function getModelsManufacturer($id)
    {
        $tm = CrossDbModel::findOne(1);

        if($_SESSION['idSessionCross'] == '') self::initCross();

        $data['host'] = $tm['host'];
        $data['action'] = 'getModelsManufacturer';
        $data['idSession'] = $_SESSION['idSessionCross'];
        $data['ManufacturerID'] = $id;

        $result = self::getRequestForCross($data);
        return $result;

    }

    public static function getArticlesCar($id)
    {
        $tm = CrossDbModel::findOne(1);

        if($_SESSION['idSessionCross'] == '') self::initCross();

        $data['host'] = $tm['host'];
        $data['action'] = 'getArticlesCar';
        $data['idSession'] = $_SESSION['idSessionCross'];
        $data['CarID'] = $id;


        $result = self::getRequestForCross($data);
        return $result;

    }

    public static function getArticlesSearch($article)
    {
        $tm = CrossDbModel::findOne(1);

        if($_SESSION['idSessionCross'] == '') self::initCross();

        $data['host'] = $tm['host'];
        $data['action'] = 'getArticlesSearch';
        $data['idSession'] = $_SESSION['idSessionCross'];
        $data['FoundString'] = $article;

        $result = self::getRequestForCross($data);
        return $result;

    }


}