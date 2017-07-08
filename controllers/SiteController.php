<?php

namespace app\controllers;

use app\models\AuthorizForm;
use app\models\BaseService;
use app\models\CrossDb;
use app\models\StaticPages;
use app\models\User;
use app\modules\admin\models\CarsModel;
use app\modules\admin\models\ClientModel;
use app\modules\admin\models\CrossDbModel;
use app\modules\admin\models\SupliersModel;
use stdClass;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
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

        $cars = new CarsModel();
        $IsPassengerCar = $cars->find()
            //->select(['id', 'Title'])
            ->andWhere(['IsPassengerCar' => 1])
            ->andWhere(['visible' => 1])
            ->orderBy('Description')
            ->all();
        $IsCommercialVehicle = $cars->find()
            //->select(['id', 'Title'])
            ->andWhere(['IsCommercialVehicle' => 1])
            ->andWhere(['visible' => 1])
            ->orderBy('Description')
            ->all();
        //$result = CrossDb::getManufacturers(1);
        //$result = CrossDb::getCar();

        $SupplerID = [];
        $IsMotorbike = [];
        $search = new stdClass;
        $search->article = 'eree';

        return $this->render('index',[
            'session' => $this->base,
            'IsPassengerCar' => $IsPassengerCar,
            'IsCommercialVehicle' => $IsCommercialVehicle,
            'SupplerID' => $SupplerID,
            'IsMotorbike' => $IsMotorbike,
            'search' => $search,
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

            return $this->redirect(['index']);
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
        CrossDb::sessionClose();
        Yii::$app->session->destroy();
        Yii::$app->session->open();
        $base = new BaseService;
        $base->setParNewSession();

        //Yii::$app->user->logout();
        //return $this->goHome();

        return $this->redirect(['index']);
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

            return $this->redirect(['index']);
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

    public function actionCabinet()
    {
        $id=$_SESSION['userId'];
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if($model->validate()) {
                /*$model->images = UploadedFile::getInstance($model, 'images');
                if ($model->images) {
                    $image_name = 'images/avatars/' . $model->id. '.png';
                    $model->images->saveAs($image_name);
                }*/
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('cabinet', [
                'model' => $model,
            ]);
        }
    }

    public function actionCabinet_supl()
    {
        $id=$_SESSION['supl_id'];
        if (($model = SupliersModel::findOne($id)) == null) $model = [];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if($model->validate()) {
                /*$model->images = UploadedFile::getInstance($model, 'images');
                if ($model->images) {
                    $image_name = 'images/avatars/' . $model->id. '.png';
                    $model->images->saveAs($image_name);
                }*/
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('cabinet_supl', [
                'model' => $model,
            ]);
        }
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

    public function actionPages()
    {
        $pageId = Yii::$app->request->get('id');
        $suplId = Yii::$app->request->get('supl');
        $pageModel = new StaticPages();
        $page=$pageModel->getPageId($pageId);

        $suplModel = new SupliersModel();
        $supl=$suplModel->getFullID($suplId);


        return $this->render('pages', [
            'supl' => $supl,
            'page' => $page
        ]);
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

    protected function findModel($id)
    {
        if (($model = ClientModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
