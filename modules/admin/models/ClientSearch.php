<?php

namespace app\modules\admin\models;

//use app\modules\admin\models\BannerModel;
//use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * @property mixed columns
 * @property mixed service
 * @property mixed town
 * @property mixed courier_base
 * @property mixed receiver_name
 * @property mixed receiver_phone
 * @property mixed hide_art
 */
class ClientSearch extends ClientModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['id', 'integer'],
            ['columns', 'integer'],
            ['login', 'safe'],
            ['role', 'safe'],
            ['user_code', 'safe'],
            ['user_name', 'safe'],
            ['email', 'safe'],
            ['phone',  'safe'],
//            [['activate_hash'],  'safe'],
            ['activity','in','range'=>['y','n'], 'strict'=>true, 'message' => 'Введите y / n'],
            ['service', 'safe'],
            ['town', 'safe'],
            ['courier_base', 'safe'],
            ['receiver_name', 'safe'],
            ['receiver_phone', 'safe'],
            ['hide_art', 'safe'],
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
        $query = ClientModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }
        $query
            ->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'columns', $this->columns])
            ->andFilterWhere(['like', 'login', $this->login])
            ->andFilterWhere(['like', 'role', $this->role])
            ->andFilterWhere(['like', 'user_code', $this->user_code])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'activity', $this->activity])
            ->andFilterWhere(['like', 'service', $this->service])
            ->andFilterWhere(['like', 'town', $this->town])
            ->andFilterWhere(['like', 'courier_base', $this->courier_base])
            ->andFilterWhere(['like', 'receiver_name', $this->receiver_name])
            ->andFilterWhere(['like', 'receiver_phone', $this->receiver_phone])
            ->andFilterWhere(['like', 'hide_art', $this->hide_art])
            ->andFilterWhere(['like', 'user_name', $this->user_name]);
        return $dataProvider;
    }
}
