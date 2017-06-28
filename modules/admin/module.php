<?php

namespace app\modules\admin;

use app\models\BaseService;

class module extends \yii\base\Module
{
    private $base;
    public $controllerNamespace = 'app\modules\admin\controllers';

    public function init()
    {
        parent::init();
//        if(!User::getInstance()->isAdmin()) {
//            throw new NotFoundHttpException('Запрашиваемая страница не существует');
//        }
        $this->base = new BaseService();
        if ($_SESSION['role'] != 'admin') {
            header('Location:/');
            exit;
        }
    }
}
