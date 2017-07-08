<?php

namespace app\models;

use Yii;

class BaseService {

    public $session_id = '';
    public $idSessionCross = '';
    public $login = 0;
    public $userId = 0;
    public $role = 'unreg';
    public $userCode = '';
    public $userName = '';
    public $email = '';
    public $supl_id = 0;


    public function setParNewSession()
    {
        $_SESSION['session_id'] = session_id();
        $_SESSION['idSessionCross'] = $this->idSessionCross;
        $_SESSION['login'] = $this->login;
        $_SESSION['userId'] = $this->userId = time() * (-1);//$this->userId;
        $_SESSION['role'] = $this->role;
        $_SESSION['userCode'] = $this->userCode;
        $_SESSION['userName'] = $this->userName;
        $_SESSION['email'] = $this->email;
        $_SESSION['supl_id'] = $this->supl_id;

    }


    function __construct(){
        //@session_start();
        if (!Yii::$app->session->isActive) {
            Yii::$app->session->open();
        }

        if(!isset($_SESSION['userCode'])) {
            $this->setParNewSession();
        } else {
            //echo '<pre>'; var_dump($_SESSION);
            $this->session_id = $_SESSION['session_id'];
            //$this->sessionOpen = $_SESSION['sessionOpen'];
            $this->login = $_SESSION['login'];
            $this->userId = $_SESSION['userId'];
            $this->role = $_SESSION['role'];
            $this->userCode = $_SESSION['userCode'];
            $this->userName = $_SESSION['userName'];
            $this->email = $_SESSION['email'];
            $this->supl_id = $_SESSION['supl_id'];

            if(isset($_SESSION['idSessionCross'])) $this->idSessionCross = $_SESSION['idSessionCross'];
            else $this->idSessionCross = $_SESSION['idSessionCross'] = '';
        }

        /*if(isset($_SESSION['maxlifetime']) && time() > $_SESSION['maxlifetime']){
           unset($_SESSION['maxlifetime']);
           header( 'Location: /exit');
           exit;
        }*/

    }

    public static function SaveLogCrossDb($message,$function_name)
    {
        Yii::error(["Ошибка в функции ".$function_name,$message], "cross_db");
    }

    public static function OnlyLettersAndDigits($str)
    {
        return preg_replace("/([^\w]|_)/u", "", $str);
    }

    public static function ClearFloat($str)
    {
        $str = preg_replace("/([^\d,.])/u", "", $str);
        $str = preg_replace("/,/u", ".", $str);
        $str = (float)$str;
        return $str;
    }

}