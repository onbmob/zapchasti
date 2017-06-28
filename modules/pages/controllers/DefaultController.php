<?php
namespace app\modules\pages\controllers;

use app\models\BaseService;
use app\models\StaticPages;
use yii;
use yii\web\Controller;

class DefaultController extends Controller {
    private $base;
    public function init(){
        parent::init();
        $this->base = new BaseService();
        if($this->base->alarmTo == 1) {
            //return $this->redirect('/alarm');
            header( 'Location: /alarm');
            exit;
        }

        //if($this->base->role == 'unreg') $this->redirect('/index');

        /*
        //Если гость - редиректим на авторизацию
        if(Yii::$app->user->isGuest){
            $this->redirect('/login');
        }
        */
    }
    public function actionIndex() {
    }

    function actionDisplayStaticPage() {
        $parts = explode('/', Yii::$app->request->url);
        $url = array_pop($parts);
        $model = StaticPages::findOne([
            'url' => $url
        ]);
        if(is_null($model)) {
            return $this->redirect($this->goHome());
        }
        return $this->render('staticPage', [
            'page' => $model
        ]);
    }

}
