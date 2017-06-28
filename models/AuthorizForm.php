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
    public $name;
    public $email;
    public $phone;
    public $error='';
    public $verifyCode;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['username', 'password', 'name', 'email', 'phone', 'body'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
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
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function authoriz($email)
    {
        //if ($this->validate()) {
            $res = User::findByUsernameOrEmailDb($this->username, $this->email);
            if(count($res) > 0 ) {
                //echo 'LOGIN - '.$this->username.'<pre>'; var_dump($res);
                $this->error = 'уже есть такой логин или E-mail';
                return false;
            }

            $ori_pasw = $this->password;
            $this->password = md5($this->password);
            User::saveUser($this);
            $mail = new MailModel();
            $mail->sendRegistration($this,$ori_pasw);

           /* Yii::$app->mailer->compose()
                ->setTo($email)
                ->setFrom([$this->email => $this->name])
                ->setSubject('REGISTRATION')
                ->setTextBody('Регистрация прошла успешно')
                ->send();*/

            //echo 'Registration is ready';
            return true;
        //}

        return false;
    }
}
