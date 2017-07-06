<?php

namespace app\models;

use stdClass;
use Yii;
use yii\db\ActiveRecord;
use app\modules\admin\models\CrossDbModel;

class userDb extends ActiveRecord
{
    public $db;
    private $base;
    private $limit_of_rows = 1000; // Максимум строк из базы
    private $cache_live_time = 900; // Время жизни кеша секунд
    private $enable_cache = false;   // Кешировать запросы к базе и 1С
    private $enable_perf_log = false; // Логировать скорость запросов к базе
    private $ft_min_word_len = 3; // Опция конфига mysql минимальный размер слова для индексации


    public function TehnomirSearch($params)
    {
        $article = $params["name"];
        $return = $cross_code = [];

        $tm = CrossDbModel::findOne(1);

        $host = $tm['host'];
        $host .= '?act=GetPriceWithCrosses';
        $host .= '&usr_login=' . $tm['username'];
        $host .= '&usr_passwd=' . $tm['password'];

        /*
                $ch = curl_init($host);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
                //curl_setopt($ch, CURLOPT_POST,1);
        */

        $ch = curl_init(); // действие раз. объявили ресурс
        curl_setopt_array($ch, array( // действие два. установили опции.
            CURLOPT_FOLLOWLOCATION => true, // следовать перенаправлениям...
            CURLOPT_MAXREDIRS => 10, // ... но не более 10 раз
            CURLOPT_RETURNTRANSFER => true, // смешная третья опция
            CURLOPT_TIMEOUT => 10, // Сколько сек. ждать ответ сервреа (комментарий взят из вашего сообщения, порядок букв сохранен)
            CURLOPT_URL => $host // вот этой строки можно избегать инициализируя сразу с адресом. но вам проще иметь ее тут.
        ));

        $result = curl_exec($ch);

        if ($result === false) {
            echo 'ОШИБКА РАБОТЫ С УДАЛЕННЫМ САЙТОМ : ' . curl_error($ch);
            curl_close($ch);
            return array($return, $cross_code);
        }
        curl_close($ch);

        libxml_use_internal_errors(true);
        $error = $result;
        $result = simplexml_load_string($result);

        if (!$result) {
            echo $host . '<br>';
            echo 'ОШИБКА В ЗАПРОСЕ НА УДАЛЕННЫЙ САЙТ : ' . $params["name"] . ' ' . $error;
            libxml_clear_errors();
            return array($return, $cross_code);
        }

       return array($return, $cross_code);

    }

}