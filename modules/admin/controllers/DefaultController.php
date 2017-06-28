<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;

class DefaultController extends Controller
{
    public function actions()
    {
        return [
            'image-upload' => [
                'class' => 'vova07\imperavi\actions\UploadAction',
                'url' => '/images/pages', // URL адрес папки куда будут загружатся изображения.
                'path' => '@app/web/images/pages' // Или абсолютный путь к папке куда будут загружатся изображения.
            ],
        ];
    }
    public function actionIndex()
    {
        return $this->render('index');
    }
}
