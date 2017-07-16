<?php
namespace app\modules\search\controllers;

use app\models\BaseService;
use app\models\CrossDb;
use app\models\PriceDb;
use yii;
use yii\web\Controller;

class DefaultController extends Controller {
    private $base;
    public function init(){
        parent::init();
        $this->base = new BaseService();
    }
    public function actionIndex() {
        return $this->render('index', [
            'brand' => []
        ]);
    }

    function actionSearchTypeBrand() {

        $type = Yii::$app->request->get('type');
        $brand = CrossDb::getManufacturers($type);
        if(isset($brand['data'])){
            if(count($brand)>1){
                usort($brand['data'], function ($a, $b) {
                    return (strnatcasecmp(str_replace(' ','',$a['Description']), str_replace(' ','',$b['Description'])));
                });
            }
        } else $brand['data'] = [];

        return $this->render('search-type-brand', [
            'type' => $type,
            'brand' => $brand
        ]);
    }

    function actionGetModelsManufacturer() {

        $id = Yii::$app->request->get('id');
        $brand = Yii::$app->request->get('brand');
        $models = CrossDb::getModelsManufacturer($id);
        if(isset($models['data'])){
            if(count($models)>1){
                usort($models['data'], function ($a, $b) {
                    if($a['ConstructionIntervalFrom'] > $b['ConstructionIntervalFrom']) return (-1);
                    return 1;
                });
            }
        } else $models['data'] = [];

        return $this->render('get-models-manufacturer', [
            'id' => $id,
            'brand' => $brand,
            'models' => $models
        ]);
    }

    function actionGetArticlesCar() {//получить детали автомобиля

        $id = Yii::$app->request->get('id');
        $brand = Yii::$app->request->get('brand');
        $model = Yii::$app->request->get('model');
        $result = CrossDb::getArticlesCar($id);
        /*usort($models['data'], function ($a, $b) {
            if($a['ConstructionIntervalFrom'] > $b['ConstructionIntervalFrom']) return (-1);
            return 1;
        });*/

        return $this->render('get-articles-car', [
            'id' => $id,
            'brand' => $brand,
            'model' => $model,
            'result' => $result
        ]);
    }

    function actionGetArticlesSearch() {// получить детали по номеру. <=> GetArticlesCar()//получить детали автомобиля

        $article = Yii::$app->request->get('article');
        $result = CrossDb::getArticlesSearch($article);
        if(isset($result['data'])){
            if(count($result['data'])>1){
                usort($result['data'], function ($a, $b) {
                    return (strnatcasecmp(str_replace(' ','',$a['DataSupplierArticleNumber']), str_replace(' ','',$b['DataSupplierArticleNumber'])));
                });
            }

            $mas1 = $mas2 =[];
            foreach($result['data'] as $item) {
                if (stripos(BaseService::OnlyLettersAndDigits($item['DataSupplierArticleNumber']), BaseService::OnlyLettersAndDigits($article)) !== false ){
                    $item['ori']= true;
                    $mas1[] = $item;
                }
                else $mas2[] = $item;
            }
            $result['data'] = array_merge($mas1,$mas2);
        } else $result['data'] = [];

        return $this->render('get-articles-search', [
            'article' => $article,
            'result' => $result
        ]);
    }

    function actionSearchFromDb() {// получить детали по номеру. <=> GetArticlesCar()//получить детали автомобиля

        $params = Yii::$app->request->get();
        $result = [];
        $price = new PriceDb();
        $title = 'Ошибка поиска - неизвестный тип поиска';
        switch($params['type']){
            case '1'://Поиск по аортикулу и бренду
                $title = $params['brand'].' / '.$params['article'];
                $result['data'] = $price->SearchByArtBrand($params);
                break;
            case '2'://Поиск по наименованию
                $title = $params['name'];
                $result['data'] = $price->SearchByName($params);
                break;
        }

        return $this->render('search-from-db', [
            'title' => $title,
            'params' => $params,
            'result' => $result
        ]);
    }

}
