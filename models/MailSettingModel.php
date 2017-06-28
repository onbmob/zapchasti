<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "mailsetting".
 *
 * @property integer $id
 * @property string $class
 * @property string $host
 * @property string $username
 * @property string $password
 * @property integer $port
 */
class MailSettingModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mailsetting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['host', 'username', 'password',], 'required'],
            [['port'], 'integer'],
            [['class', 'host', 'username', 'password'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'class' => 'Тип соединения',
            'host' => 'Адрес сервиса',
            'username' => 'Пользователь',
            'password' => 'Пароль',
            'port' => 'Порт для отправки',
        ];
    }

    public static function getSetting(){
        $result = self::find()
            ->where(['id' => 1])
            ->asArray()
            ->one();

        $return = [
            'class' => $result['class'],
            'host' => $result['host'],
            'username' => $result['username'],
            'password' => $result['password'],
            'port' => $result['port'],
        ];

/*
        $return = [
            'class' => 'Swift_SmtpTransport',
            'host' => '91.206.200.249',
            'username' => 'avdtrade@avdtrade.com',
            'password' => 'nT20f8dS',
            'port' => '2525',
        ];
*/
        return $return;
    }
}
