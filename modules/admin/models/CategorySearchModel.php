<?php

namespace app\modules\admin\models;
use kartik\tree\models\Tree;
use yii;
use yii\web\UploadedFile;

class CategorySearchModel extends Tree
{
    public $images;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu_stat_pages';
    }

    /**
     * Override isDisabled method if you need as shown in the
     * example below. You can override similarly other methods
     * like isActive, isMovable etc.
     */
    public function isDisabled()
    {
//        if (Yii::$app->user->username !== 'admin') {
//            return true;
//        }
        return false; //parent::isDisabled();
    }

    public function rules()
    {
        $rules = parent::rules();
        $rules[] = ['parent', 'safe'];
        $rules[] = ['title', 'safe'];
        $rules[] = ['page_id', 'safe'];
        return $rules;
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $attributeLabels = parent::attributeLabels();
        $attributeLabels['parent'] = 'Родитель';
        $attributeLabels['page_id'] = 'Статическая страница';
        return $attributeLabels;
    }

    public function get(){

        $sql = "SELECT * key_phrase FROM ".$this->tableName()."
                WHERE lvl > 0 AND  active = true;";

        $return = Yii::$app->db->createCommand($sql)->queryAll();
        return $return;

        /*$result = self::find()
            ->where("lvl > 0")
            ->andWhere(['active'=>true])
            ->addOrderBy('root, lft')
            ->all();
        return $result;*/
    }
    public function getLft($lft,$rgt, $lvl, $root){

        /*$sql = "SELECT * FROM ".$this->tableName()."
                WHERE lvl = '" . $lvl . "'
                AND  active = true
                AND  lft > '" . $lft . "'
                AND  lft < '" . $rgt . "'
                ;";

        $return = Yii::$app->db->createCommand($sql)->queryAll();
        return $return;*/

        $result = self::find()->asArray()
            //->select("name, lft, rgt, lvl")
            ->where(['lvl' => $lvl])
            ->andWhere(['root' => $root])
            ->andWhere(['active'=>true])
            ->andWhere('lft > :a', ['a' => $lft])
            ->andWhere('lft < :b', ['b' => $rgt])
            //->addOrderBy('root, lft')
            ->all();
        return $result;
    }

    public function getlvl($lvl){

        /*$sql = "SELECT * FROM ".$this->tableName()."
                WHERE lvl = '" . $lvl . "' AND  active = true;";

        $return = Yii::$app->db->createCommand($sql)->queryAll();
        return $return;*/

        $result = self::find()->asArray()
            //->select("name, lft, rgt, lvl")
            ->where(['lvl' => $lvl])
            ->andWhere(['active'=>true])
            //->addOrderBy('root, lft')
            ->all();
        return $result;
    }

    public function getID($id){
        $result = self::find()
            ->Where(['id'=>$id])
            ->one();
        return $result;
    }

}