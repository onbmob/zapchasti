<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "staticpages".
 * @property integer $id
 * @property string  $Title
 * @property string  $url
 * @property string  $beforeContent
 * @property string  $content
 * @property string  $afterContent
 * @property string  $keywords
 * @property string  $description
 * @property integer $topMenu
 * @property integer $position
 */
class StaticPages extends \yii\db\ActiveRecord {
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'staticpages';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['Title', 'url', 'content', 'keywords', 'description'], 'required'],
            [['keywords', 'description'], 'string'],
            [['topMenu'], 'boolean'],
            [['position'], 'integer'],
            [['beforeContent', 'content', 'afterContent'], 'safe'],
            [['Title', 'url'], 'string', 'max' => 250],
            [['url'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'Title' => 'Заголовок',
            'url' => 'Адрес',
            'beforeContent' => 'До содержания',
            'content' => 'Содержание',
            'afterContent' => 'После содержания',
            'keywords' => 'Ключевые слова (keywords)',
            'description' => 'Описание (description)',
            'topMenu' => 'Включить в верхнее меню',
            'position' => 'Позиция',
        ];
    }
}