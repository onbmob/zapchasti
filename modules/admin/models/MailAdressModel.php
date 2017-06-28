<?php

namespace app\modules\admin\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "mailadress".
 *
 * @property integer $id
 * @property string $group
 * @property string $email
 */
class MailAdressModel extends \yii\db\ActiveRecord
{

    public $groupType = [
        'manager' => 'Менеджер',
        'admin' => 'Администратор',
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mailadress';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group'], 'string'],
            [['email'], 'required'],
            [['email'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'group' => 'Группа получателей',
            'email' => 'Email получателя',
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params) {
        $query = self::find()->orderBy('group');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if(!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'group' => $this->group,
            'email' => $this->email
        ]);

        $query->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'group', $this->group]);

        return $dataProvider;
    }

    public function getForGroup($group){
        $result = self::find()
            ->where(['group' => $group])
            ->all();

        if(is_null($result)){
            $result = self::find()
                ->where(['group' => 'default'])
                ->all();
        }
        return $result;
    }
}
