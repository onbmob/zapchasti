<?php

namespace app\controllers;

use app\models\AuthorizForm;
use app\models\BaseService;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public $base;

    public function init(){
        parent::init();
        $this->base = new BaseService();
    }
/*
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
*/
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index',[
            'session' => $this->base
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->render('index');
            //return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {

//echo '<pre>'; var_dump($_SESSION); die;
        Yii::$app->session->destroy();
        Yii::$app->session->open();
        $base = new BaseService;
        $base->setParNewSession();

        //Yii::$app->user->logout();
        //return $this->goHome();
        return $this->render('index',[
            'session' => $this->base
        ]);
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */

    public function actionAuthoriz()
    {
        $model = new AuthorizForm();
        if ($model->load(Yii::$app->request->post()) && $model->authoriz(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->render('index');
            //return $this->refresh();
        }

        return $this->render('authoriz', [
            'model' => $model,
        ]);
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /*
 * Подтверждение подписки.
 * В качестве GET-параметра принимается код, который сравнивается с тем, что в таблице subscription
 * в ячейке activation. При успехе - ставится true в ячейку status.
 */
    public function actionActivation(){
        $code = Yii::$app->request->get('code');
        $code = Html::encode($code);
        $find = User::findActivate($code);
        if($find){
            $find->activity = 'y';
            if ($find->save()) {
                $text = '<p>Поздравляю!</p>
            <p>Ваш e-mail подтвержден.</p>';
                //страница подтверждения
                return $this->render('activation', [
                    'text' => $text
                ]);
            }
        }
        $absoluteHomeUrl = Url::home(true);
        return $this->redirect($absoluteHomeUrl, 303); //на главную
    }

}
