<?php

namespace app\modules\admin\models;

use Yii;

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
class CrossDbModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cross_db';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['host', 'username', 'password',], 'required'],
            [['name', 'host', 'username', 'password'], 'string', 'max' => 150]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'host' => 'Адрес сервиса',
            'username' => 'Логин',
            'password' => 'Пароль',
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
        ];

        return $return;
    }
}
