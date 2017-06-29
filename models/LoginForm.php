<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;
    public $error='';

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'password' => 'Пароль',
        ];
    }

    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }


    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }


    public function login()
    {
        //if ($this->validate()) {
            //return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
            return $this->getUser();
        //}
        //return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $password = md5($this->password);
            $this->_user = User::findByUsernameAndPaswDb($this, $password);
            if(count($this->_user) > 0) {
                if($this->_user[0]['activity'] != 'y'){
                    $this->error = 'учетная запись не активна';
                    return false;
                } else {//Вошли
                    //-----------------
                    Yii::$app->session->destroy();
                    Yii::$app->session->open();
                    $base = new BaseService;
                    $base->setParNewSession();
                    //-----------------
                    $_SESSION['login'] = $this->_user[0]['login'];
                    $_SESSION['userId'] = (int)$this->_user[0]['id'];
                    $_SESSION['role'] = $this->_user[0]['role'];
                    $_SESSION['userCode'] = $this->_user[0]['user_code'];
                    $_SESSION['userName'] = $this->_user[0]['user_name'];
                    $_SESSION['email'] = $this->_user[0]['email'];
                    return $this->_user;
                }
                //return true;
            } else {
                $this->error = 'неверный логин или пароль';
                return false;
            }
        }

       // return $this->_user;
    }
}
