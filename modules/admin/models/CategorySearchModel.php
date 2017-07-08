<?php

namespace app\modules\admin\models;
use app\models\StaticPages;
use kartik\tree\models\Tree;
use yii;
use yii\helpers\ArrayHelper;
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

    /*public function get(){

        $sql = "SELECT * key_phrase FROM ".$this->tableName()."
                WHERE lvl > 0 AND  active = true;";

        $return = Yii::$app->db->createCommand($sql)->queryAll();
        return $return;

    }*/

    public static function getLft($lft,$rgt, $lvl){

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
            ->andWhere(['active'=>true])
            ->andWhere('lft > :a', ['a' => $lft])
            ->andWhere('lft < :b', ['b' => $rgt])
            ->addOrderBy('root, lft')
            ->all();
        return $result;
    }

    public static function getlvl($lvl){

        $result = self::find()->asArray()
            //->select("name, lft, rgt, lvl")
            ->where(['lvl' => $lvl])
            ->andWhere(['active'=>true])
            ->addOrderBy('root, lft')
            ->all();
        return $result;
    }

    public function getID($id){
        $result = self::find()
            ->Where(['id'=>$id])
            ->one();
        return $result;
    }

    public static $null_mas = [
        'id' => 0,
        'supliers' => 0,
        'title' => '',
    ];

    public static function getPagesListKartik()
    {
        $level = 1;
        $lvl = self::getlvl($level);

        $in=ArrayHelper::getColumn($lvl,'page_id');
        $mas = StaticPages::find()->asArray()
            ->select(['id', 'Title', 'supliers'])->where(['id' => $in])->all();
        $mas = ArrayHelper::index($mas,'id');

        $result = [];
        foreach($lvl as $item){
            $level = 2;
            $root = $item['id'];
            if(!isset($mas[$item['page_id']])){
                $stpages = self::$null_mas;
                $stpages['title'] = $item['name'];
            } else {
                $stpages = $mas[$item['page_id']];
                $stpages['title'] = $item['name'];
            }

            $res = self::getPagesListKartikSection($item['lft'],$item['rgt'], $level);
            if($res !== null) $stpages['sections'] = $res;
            $result[] = $stpages;
        }

        return $result;
    }

    public static function getPagesListKartikSection($lft, $rgt , $level)
    {
        $result = [];
        if($level > 3) return $result; //В меню только 3 вложения !!!!!
        $lvl = self::getLft($lft,$rgt, $level);
        if($lvl == null) return $result;

        $in=ArrayHelper::getColumn($lvl,'page_id');
        $mas = StaticPages::find()->asArray()
            ->select(['id', 'Title', 'supliers'])->where(['id' => $in])->all();
        $mas = ArrayHelper::index($mas,'id');

        foreach($lvl as $item){
            if(!isset($mas[$item['page_id']])) { continue; }
            $stpages = $mas[$item['page_id']];
            $stpages['title'] = $item['name'];
            $stpages['sections'] = self::getPagesListKartikSection($item['lft'],$item['rgt'], $level+1);
            $result[] = $stpages;
        }
        return $result;
    }


}