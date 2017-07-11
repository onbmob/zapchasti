<?php

namespace app\modules\admin\models;



use yii\base\Model;

class FilesModel extends Model
{
    public $file;
    public $title= 'Загрузка файла';

    public function rules()
    {
        return [

            ['file','file'],

        ];
    }
}
