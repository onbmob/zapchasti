<?php

namespace app\models;

//class User extends \yii\base\Object implements \yii\web\IdentityInterface
use Yii;
use yii\db\ActiveRecord;

class User extends ActiveRecord
{
    public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;

    public static function tableName()
    {
        return 'users';
    }

/*
    private static $users = [
        '100' => [
            'id' => '100',
            'username' => 'admin',
            'password' => 'admin',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ],
        '101' => [
            'id' => '101',
            'username' => 'demo',
            'password' => 'demo',
            'authKey' => 'test101key',
            'accessToken' => '101-token',
        ],
    ];


    public static function findIdentity($id)
    {
        return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }
*/

    public static function saveUser($data)
    {
        $return = Yii::$app->db->createCommand()->insert(self::tableName(), [
            'login' => $data->username,
            'pwd' => $data->password,
            'user_name' => $data->name,
            'email' => $data->email,
            'phone' => $data->phone,
        ])->execute();
    }

    public static function findByUsernameOrEmailDb($username, $email)
    {
        $result = self::find()->asArray()
            //->select("name, lft, rgt, lvl")
            ->where(['login' => $username])
            ->orWhere(['email' => $email])
            //->addOrderBy('root, lft')
            ->all();
        //echo '<pre>'; var_dump($result); die;
        return $result;
    }

    public static function findByUsernameAndPaswDb($username,$password)
    {
        $result = self::find()->asArray()
            //->select("name, lft, rgt, lvl")
            ->where(['login' => $username])
            ->andWhere(['pwd' => $password])
            //->addOrderBy('root, lft')
            ->all();
        //echo '<pre>'; var_dump($result); die;
        return $result;
    }

    /*
        public static function findByUsername($username)
        {
            foreach (self::$users as $user) {
                if (strcasecmp($user['username'], $username) === 0) {
                    return new static($user);
                }
            }

            return null;
        }

        public function getId()
        {
            return $this->id;
        }

        public function getAuthKey()
        {
            return $this->authKey;
        }

    */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public function validatePassword($password)
    {
        return $this->password === $password;
    }
}
