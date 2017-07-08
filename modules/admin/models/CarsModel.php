<?php

namespace app\modules\admin\models;

//use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;

/**
 * @property mixed columns
 * @property mixed service
 * @property mixed town
 * @property mixed courier_base
 * @property mixed receiver_name
 * @property mixed receiver_phone
 * @property mixed hide_art
 */
class CarsModel extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cars';
    }
    public function rules()
    {
        return [
            ['id', 'integer'],
            ['CarId', 'integer'],
            ['Description', 'safe'],
            ['synonium', 'safe'],

            ['SupplerID', 'integer'],
            ['CanBeDisplayed', 'integer'],
            ['IsPassengerCar', 'integer'],
            ['IsCommercialVehicle', 'integer'],
            ['IsMotorbike', 'integer'],
            ['IsEngine', 'integer'],
            ['IsAxle', 'integer'],

            ['visible', 'integer'],

        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'CarId' => 'Код',
            'Description' => 'Наименование',
            'synonium' => 'Синоним',
            'SupplerID' => 'Запчасти',
            'CanBeDisplayed' => 'Оригинальный производитель',
            'IsPassengerCar' => 'Легковые авто',
            'IsCommercialVehicle' => 'Грузовые авто',
            'IsMotorbike' => 'Мотоциклы',
            'IsEngine' => 'Производитель двигателей',
            'IsAxle' => 'Производитель осей (мостов)',
            'visible' => 'Показывать',
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
        $query = CarsModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }
        $query
            ->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'CarId', $this->CarId])
            ->andFilterWhere(['like', 'Description', $this->Description])
            ->andFilterWhere(['like', 'synonium', $this->synonium])
            ->andFilterWhere(['like', 'SupplerID', $this->SupplerID])
            ->andFilterWhere(['like', 'CanBeDisplayed', $this->CanBeDisplayed])
            ->andFilterWhere(['like', 'IsPassengerCar', $this->IsPassengerCar])
            ->andFilterWhere(['like', 'IsCommercialVehicle', $this->IsCommercialVehicle])
            ->andFilterWhere(['like', 'IsMotorbike', $this->IsMotorbike])
            ->andFilterWhere(['like', 'IsEngine', $this->IsEngine])
            ->andFilterWhere(['like', 'IsAxle', $this->IsAxle])
            ->andFilterWhere(['like', 'visible', $this->visible])
            ->orderBy('Description');
        return $dataProvider;
    }
}