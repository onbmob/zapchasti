<?php

namespace app\modules\admin\models;

use app\models\MailModel;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "users_onb".
 *
 * @property integer $id
 * @property string $name
 * @property mixed user_name
 * @property mixed login
 * @property mixed supl_name
 * @property mixed email
 * @property mixed phone
 * @property mixed pwdNew
 * @property mixed role
 * @property mixed activity
 * @property string pwd
 * @property mixed brand
 */
class SupliersModel extends ActiveRecord
{
    public $pwdNew;
    public $pwdRepeat;
    public $chmail;
    public $images;
    protected $template_symbols = array(0, 3, 5, 0, 2, 3, 2, 1, 4);

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'supliers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            ['id', 'integer'],

            //['columns', 'integer'],

            ['pwdNew', 'string', 'max' => 50, 'min' => 4],
            ['pwdRepeat', 'compare', 'skipOnEmpty' => false, 'compareAttribute' => 'pwdNew'],

            ['login', 'string', 'max' => 50, 'min' => 4],
            ['login', 'unique', 'targetClass' => self::className(), 'message' => 'Такой логин уже существует.'],

            [['role'], 'string', 'max' => 10],

            ['supl_code', 'string', 'max' => 30, 'min' => 4],
            ['supl_code', 'unique', 'targetClass' => self::className(), 'message' => 'Такой код поставщика уже существует.'],

            ['supl_name', 'string', 'max' => 30, 'min' => 4],
            ['user_name', 'string', 'max' => 255, 'min' => 4],

            ['email', 'email'],
            ['email', 'unique', 'targetClass' => self::className(), 'message' => 'Такой E-mail уже существует.'],

            ['skype', 'string', 'max' => 100],
            ['icq', 'string', 'max' => 100],

            ['phone', 'string', 'max' => 100],

            [['activate_hash'], 'string', 'max' => 100],

            ['activity', 'in', 'range' => ['y', 'n'], 'strict' => true, 'message' => 'Введите y / n'],

            ['service', 'string', 'max' => 100],

            ['town', 'string', 'max' => 100],

            ['courier_base', 'string', 'max' => 100],

            ['receiver_name', 'string', 'max' => 100],

            ['receiver_phone', 'string', 'max' => 100],

            ['chmail', 'integer'],
            ['region', 'integer'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Логин',
            'pwd' => 'Хеш пароля',
            'pwdRepeat' => 'Подтверждение пароля',
            'pwdNew' => 'Новый пароль (если нужно сменить)',
            'role' => 'Тип',
            'supl_code' => 'Код поставщика',
            'supl_name' => 'Поставщик',
            'region' => 'Регион',
            'user_name' => 'Ответственное лицо',
            'email' => 'Почта',
            'skype' => 'skype',
            'icq' => 'icq',
            'phone' => 'Телефон пользователя',
            'activity' => 'Активность (y/n)',
            'activate_hash' => 'Хеш активации',
            //'columns' => 'Карточек на странице',
            'service' => 'service',
            'town' => 'Код города',
            'courier_base' => 'Код отделения',
            'receiver_name' => 'Имя получателя',
            'receiver_phone' => 'Телефон получателя',
            'chmail' => 'Уведомить пользователя письмом',
            //'hide_art' => 'Скрывать артикул',
        ];
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if ($this->chmail) {
            $mailmodel = new MailModel();
            $img = '';
            $str = 'Добрый день уважаемый поставщик '.$this->supl_name.' ( '.$this->user_name.')!<br><br>';
            $str .= 'Ваша учетная запись ' . $this->login;
            if ($this->activity === 'y') {
                $str .= ' активирована на сайте http://zaphasti.nirax.ru/, пожалуйста, войдите по следующим данным :<br>';
                $str .= 'логин: ' . $this->login . '<br>';
                $str .= 'E-mail: ' . $this->email . '<br>пароль';
                if ($this->pwdNew != '') {
                    $str .= ': ' . $this->pwdNew . '<br><br>';
                    $str .= 'Рекомендуем после входа на сайт поменять пароль в "личном кабинете"<br>';
                } else {
                    $str .= ', указанный Вами при регистрации.<br>';
                }
                $img = '';//'images/mail1.jpg';
            } else {
                $str .= 'не активирована, свяжитесь с Вашим менеджером.';
            }

            $mailmodel->sendClientMail(
                $this->email,
                'Уведомление',
                $str,
                $img
            );
        }
        if ($this->role != 'admin') {
            $this->role = 'user';
        }
        if ($this->pwdNew != '') {
            $this->pwd = md5($this->pwdNew);
            $this->pwdNew = '';
            $this->pwdRepeat = '';
        }
        return parent::beforeSave($insert);
    }

    public function OLDbeforeSave($insert)
    {
        if ($this->chmail) {
            $mailmodel = new MailModel();
            $str = 'Уважаемый поставщик '.$this->supl_name.' ( '.$this->user_name.' ). Данные Вашей учетной записи<br>';
            $str .= 'Логин ' . $this->login . '<br>';
            if ($this->activity === 'y') {
                $str .= 'Учетная запись активирована<br>';
            } else {
                $str .= 'Учетная запись НЕ активирована<br>';
            }
            $str .= 'Поставщик ' . $this->supl_name . '<br>';
            $str .= 'Ответственное лицо ' . $this->user_name . '<br>';
            $str .= 'Почта            ' . $this->email . '<br>';
            $str .= 'Телефон ' . $this->phone . '<br>';
            if ($this->pwdNew != '') {
                $str .= 'Ваш пароль поменялся, новый пароль ' . $this->pwdNew . '<br>';
            }
            $mailmodel->sendClientMail(
                $this->email,
                'Уведомление об изменении данных пользователя',
                $str
            );
        }
        if ($this->role != 'admin') {
            $this->role = 'user';
        }
        if ($this->pwdNew != '') {
            $this->pwd = md5($this->pwdNew);
            $this->pwdNew = '';
            $this->pwdRepeat = '';
        }
        return parent::beforeSave($insert);
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = self::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }
        return $dataProvider;
    }

    private function createSalt($password)
    {
        $salt = '$1$';
        if (strlen($password) < 6) $password = '-#@*5+~';
        for ($i = 0; $i < 9; $i++) {
            $salt .= $password[$this->template_symbols[$i]];
        }
        $salt .= '$';
        return $salt;
    }

    public function getAll()
    {
        $result = self::find()->asArray()
            //->where(['id' => $id])
            ->select('id, supl_name')
            ->all();
        return $result;
    }

    public function getID($id)
    {//Для отображения названия и id
        $result = self::find()
            ->where(['id' => $id])
            ->one();
        if(isset($result['supl_name'])) return $result['supl_name'].' #'.$result['id'];
        else return null;
    }
    public function getFullID($id)
    {
        $result = self::find()->asArray()
            ->where(['id' => $id])
            ->one();
        return $result;
    }
}
