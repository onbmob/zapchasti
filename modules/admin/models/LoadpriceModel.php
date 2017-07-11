<?php

namespace app\modules\admin\models;

//use app\modules\admin\models\BannerModel;
//use Yii;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * @property mixed columns
 * @property mixed service
 * @property mixed town
 * @property mixed courier_base
 * @property mixed receiver_name
 * @property mixed receiver_phone
 * @property mixed hide_art
 */
class LoadpriceModel extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'price_loader';
    }

    public function rules()
    {
        return [
            ['id', 'integer'],
            ['supliers', 'safe'],
            ['descript', 'safe'],
            ['type', 'safe'],
            ['col_0', 'safe'],
            ['col_1', 'safe'],
            ['col_2', 'safe'],
            ['col_3', 'safe'],
            ['col_4', 'safe'],
            ['col_5', 'safe'],
            ['col_6', 'safe'],
            ['col_7', 'safe'],
            ['col_8', 'safe'],
            ['col_9', 'safe'],
            ['col_10', 'safe'],
            ['col_11', 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'supliers' => 'Поставщик',
            'descript' => 'Описание шаблона загрузки прайса',
            'type' => 'Тип файла прайса',
            'col_0' => '0 колонку прайса => в укзанное поле БД',
            'col_1' => '1 колонку прайса => в укзанное поле БД',
            'col_2' => '2 колонку прайса => в укзанное поле БД',
            'col_3' => '3 колонку прайса => в укзанное поле БД',
            'col_4' => '4 колонку прайса => в укзанное поле БД',
            'col_5' => '5 колонку прайса => в укзанное поле БД',
            'col_6' => '6 колонку прайса => в укзанное поле БД',
            'col_7' => '7 колонку прайса => в укзанное поле БД',
            'col_8' => '8 колонку прайса => в укзанное поле БД',
            'col_9' => '9 колонку прайса => в укзанное поле БД',
            'col_10' => '10 колонку прайса => в укзанное поле БД',
            'col_11' => '11 колонку прайса => в укзанное поле БД',
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return Model::scenarios();
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
        $query = LoadpriceModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }
        $query
            ->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'supliers', $this->supliers])
            ->andFilterWhere(['like', 'descript', $this->descript]);
        return $dataProvider;
    }

    public static function getColums()
    {
        $sql = "SHOW COLUMNS FROM price";
        $sql = "SELECT column_name,column_comment
                FROM information_schema.columns
                WHERE table_schema='nirax'
                and table_name='price';";

        $sql = "SELECT column_comment,column_name
                FROM information_schema.columns
                WHERE table_name = 'price';";

        $price_col = Yii::$app->db->createCommand($sql)->queryAll();
        $price_col = ArrayHelper::map($price_col, 'column_name', 'column_comment');
        foreach($price_col as $key => $item){
            if(substr($key , 0,1) !='_') unset($price_col[$key]);
            else $price_col[$key] = $price_col[$key].' ( '.$key.')';
        }
        $price_col = ['-' => '-'] + $price_col;
        return $price_col;
    }

}
