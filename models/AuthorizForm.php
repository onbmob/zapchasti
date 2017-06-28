<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class AuthorizForm extends Model
{
    public $username;
    public $password;
    public $password1;
    public $name;
    public $email;
    public $phone;
    public $error='';
    public $verifyCode;


    /**
     * @return array the validation rules.
     */

    public static function tableName()
    {
        return 'users';
    }

    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['username', 'password', 'password1', 'name', 'email', 'phone', 'body'], 'required'],
            ['password1', 'compare', 'skipOnEmpty' => false, 'compareAttribute' => 'password'],
            //['username', 'unique', 'targetClass' => self::className(), 'message' => 'Такой логин уже существует.'],
            // email has to be a valid email address
            ['email', 'email'],
            //['email', 'unique', 'targetClass' => self::className(), 'message' => 'Такой E-mail уже существует.'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
            'username' => 'Логин',
            'password' => 'Пароль',
            'password1' => 'Повторите пароль',
            'name' => 'ФИО пользователя',
            'email' => 'Почта',
            'phone' => 'Телефон ',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function authoriz()
    {
        //if ($this->validate()) {
            $res = User::findByUsernameOrEmailDb($this->username, $this->email);
            //echo '<pre>'; var_dump($res); die;
            if(count($res) > 0 ) {
                $this->error = 'уже есть такой ';
                if($res[0]['login'] == $this->username) {
                    $this->error .= 'Логин';
                    $this->addError('username', 'Уже есть такой логин');
                }
                if($res[0]['email'] == $this->email) {
                    $this->error .= ' E-mail';
                    $this->addError('email', 'Уже есть такой E-mail');
                }
                return false;
            }

            $ori_pasw = $this->password;
            $this->password = md5($this->password);
            User::saveUser($this);
            $mail = new MailModel();
            $mail->sendRegistration($this,$ori_pasw);

            return true;
        //}

        //return false;
    }
}
