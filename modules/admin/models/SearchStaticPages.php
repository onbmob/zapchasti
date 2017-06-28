<?php

namespace app\modules\admin\models;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\StaticPages;

/**
 * SearchStaticPages represents the model behind the search form about `app\models\StaticPages`.
 */
class SearchStaticPages extends StaticPages {
    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'topMenu', 'position'], 'integer'],
            [['Title', 'url', 'beforeContent', 'content', 'afterContent', 'keywords', 'description'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params) {
        $query = StaticPages::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if(!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'topMenu' => $this->topMenu,
            'position' => $this->position,
        ]);

        $query->andFilterWhere(['like', 'Title', $this->Title])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'beforeContent', $this->beforeContent])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'afterContent', $this->afterContent])
            ->andFilterWhere(['like', 'keywords', $this->keywords])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
