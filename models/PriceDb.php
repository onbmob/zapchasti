<?php

namespace app\models;

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
class PriceDb extends \yii\db\ActiveRecord
{
    public $limit_of_rows = 1000;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'price';
    }

    /**
     * @inheritdoc
     */

    public function SearchByArtBrand($params)
    {
        mb_internal_encoding('UTF8');
        $brand = BaseService::OnlyLettersAndDigits($params['brand']);
        $article = BaseService::OnlyLettersAndDigits($params['article']);

        $sql = "  SELECT *
                   FROM price
                   WHERE
                     article_clean='" . $article . "'
                   AND
                     brand_clean='" . $brand . "'
                   ORDER BY  _name
                   LIMIT " . $this->limit_of_rows;

        $result = Yii::$app->db
            ->createCommand($sql)
            ->queryAll(\PDO::FETCH_CLASS);

        return $result;
    }

    public function SearchByName($params)
    {
        mb_internal_encoding('UTF8');
        $params['name'] = trim(preg_replace ('/\s+/', ' ', $params['name']));
        //$params['name'] = preg_replace("|[\s]+|s", " ",  $params['name']);

        $search_arr = explode(' ', $params['name']);

        $fulltext_search = '';
        $like_search = '';

        foreach ($search_arr as $item) {
            $item_clean = BaseService::OnlyLettersAndDigits($item);

            if (mb_strlen($item_clean) >= 3) // По дефолту индексация fulltext начинается с 4 символов
                //$fulltext_search .= "+" . BaseService::OnlyLettersAndDigits($item) . "* ";
                $fulltext_search .= "+" . $item_clean . "* ";
            else
                $like_search .= " and _name like '%" . $item_clean . "%'";
        }

        if ($like_search != '')
            $like_search = " and (1 = 1 " . $like_search . ")";


        if ($fulltext_search != '') {
            $fulltext_search =
            "MATCH (
               _name,
               _applicability
            ) AGAINST ('$fulltext_search' IN BOOLEAN MODE) ";
        } else
            $fulltext_search = " 1 = 1 ";

        $sql = "  SELECT *
                   FROM price
                   WHERE
                     " . $fulltext_search . $like_search . "
                   ORDER BY  _name
                   LIMIT " . $this->limit_of_rows;

        $result = Yii::$app->db
            ->createCommand($sql)
            ->queryAll(\PDO::FETCH_CLASS);

        return $result;
    }

}
