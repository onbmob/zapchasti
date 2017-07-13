<?php

namespace app\modules\admin\controllers;

use app\models\BaseService;
use app\modules\admin\models\FilesModel;
use app\modules\admin\models\LoadpriceModel;
use app\modules\admin\models\SupliersModel;
use yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class LoadpriceController extends Controller
{
    public function actionIndex()
    {
        $model = new LoadpriceModel();
        $dataProviderModel = $model->search(Yii::$app->request->queryParams);
        return $this->render('index',[
            'dataProviderModel' => $dataProviderModel,
            'model' => $model
        ]);
    }
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new searchCarModel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new LoadpriceModel();

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
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    /**
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \Exception
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \Exception
     */
    public function actionUpdate($id)
    {
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
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    function actionLoadPriceFromFile(){

        $excel_col = [
            'A' => 'col_1',
            'B' => 'col_2',
            'C' => 'col_3',
            'D' => 'col_4',
            'E' => 'col_5',
            'F' => 'col_6',
            'G' => 'col_7',
            'H' => 'col_8',
            'I' => 'col_9',
            'J' => 'col_10',
            'K' => 'col_11',
            'L' => 'col_12',
            //'M' => 'col_13',
            //'N' => 'col_14',
        ];

        $model = new FilesModel();

        $error_mas = [];
        $data_st = time();
        $all_rows = 'no_request';
        if (Yii::$app->request->isPost) {
            $all_rows = 'no_model';
            $par = Yii::$app->request->post();
            $col = LoadpriceModel::find()->asArray()->where(['id' => $par["LoadpriceModel"]['id']])->one();
            $supl = SupliersModel::find()->asArray()->where(['id' => $col['supliers']])->one();

            set_time_limit(0);

            $model->file = UploadedFile::getInstance($model, 'file');

            if ($model->file && $model->validate()) {
                $all_rows = '----';
                $data = \moonland\phpexcel\Excel::import( $model->file->tempName, [
                    'setFirstRecordAsKeys' => false, // if you want to set the keys of record column with first record, if it not set, the header with use the alphabet column on excel.
                    // 'setIndexSheetByName' => true, // set this if your excel data with multiple worksheet, the index of array will be set with the sheet name. If this not set, the index will use numeric.
                    //'getOnlySheet' => 'sheet1', // you can set this property if you want to get the specified sheet from the excel data with multiple worksheet.
                ]);

                ///$sql = "DELETE FROM price WHERE supliers='".$col['supliers']."';";
                //$res = Yii::$app->db->createCommand($sql)->execute();

                $all_rows = count($data);
                $duplicate = '';
                $gl_values = '';
                $num_str = 0;
                $kol_rows = 0;
                foreach($data as $pos){ $num_str++;
                    $error = false; $masBD = [];
                    $column_str = $value_str = '';
                    foreach($pos as $key => $item){
                        $pole = $col[$excel_col[$key]];
                        if($pole == '-' ) continue;
                        if($pole == '_price') {
                            $price = BaseService::ClearFloat($item);
                            if (BaseService::ClearFloat($item) > 0 ){
                                $item = $price;
                            } else {//Неверная или нулевая цена или кол-во
                                $error = true;
                                continue;
                            }
                        }
                        if($pole == '_count') {
                            if(trim($item) == '*') $item = '100000';
                            else $item = BaseService::OnlyDigits($item);
                            if ((int)$item > 0 ){
                            } else {//Неверная или нулевая цена или кол-во
                                $error = true;
                                continue;
                            }
                        }
                        if($pole == '_article') {
                            $item = trim(BaseService::OnlyLettersDigitsBspSymb($item));//Боремся с кавычками (') и другой дрянью
                        }
                        if($pole == '_name') {
                            $item = trim(BaseService::OnlyLettersDigitsBspSymb($item));//Боремся с кавычками (') и другой дрянью
                        }
                        if($pole == '_brand') {
                            $item = trim(BaseService::OnlyLettersDigitsBspSymb($item));//Боремся с кавычками (') и другой дрянью
                        }
                        if($pole == '_applicability') {
                            $item = BaseService::OnlyLettersDigitsBspSymb($item);//Боремся с кавычками (') и другой дрянью
                        }

                        $masBD[$pole] = $item;
                        $column_str .= $pole.", ";
                        $value_str .= "'".$item."', ";
                    }

                    if( $error
                        || count($masBD) == 0
                        || !isset($masBD['_count'])
                        || !isset($masBD['_price'])
                        || !isset($masBD['_article'])
                    ) {
                        $pos['num_str'] = $num_str.' / цена или кол = 0';
                        $error_mas[] = $pos;
                        continue;
                    }

                    if(!isset($masBD['_brand'])) $masBD['_brand'] = '';
                    $masBD['supl_code'] = $supl['supl_code'];
                    $masBD['supliers'] = $supl['id'];
                    $masBD['brand_clean'] = BaseService::OnlyLettersAndDigits($masBD['_brand']);
                    $masBD['article_clean'] = BaseService::OnlyLettersAndDigits($masBD['_article']);

                    $hashcode = md5($masBD['supliers'].$masBD['_brand'].$masBD['_article'].$masBD['_price']);


                    if(stripos($duplicate, $hashcode) !== false) {//Уже есть такая запись
                        $pos['num_str'] = $num_str.' / '.$hashcode;
                        $error_mas[] = $pos;
                        continue;
                    }
                    //----------------Готовимся Писать в БД-----------------------------
                    $column_str .= "brand_clean,
                                    article_clean,
                                    supl_code,
                                    supliers,
                                    hashcode";
                    $value_str .= "'".$masBD['brand_clean']."',".
                                  "'".$masBD['article_clean']."',".
                                  "'".$masBD['supl_code']."',".
                                  "'".$masBD['supliers']."',"."'".
                                  $hashcode."'";

                    if($duplicate == '') $duplicate = " hashcode='".$hashcode."' ";
                    $duplicate .= " OR hashcode='".$hashcode."' ";
                    //----------------Пишем в БД-----------------------------
                    $kol_rows++;
                    $gl_values .= '('.$value_str.')';
                    if( ($kol_rows > 100) || ($all_rows < ($num_str+100)) ){

                        $sql = "DELETE FROM price WHERE ".$duplicate.";"; //baf9e54a0c06a2f0686768c2a987c3de
                        $res = Yii::$app->db->createCommand($sql)->execute();

                        $sql = "INSERT INTO price (".$column_str.") VALUES ".$gl_values.";";
                        $res = Yii::$app->db->createCommand($sql)->execute();
                        $gl_values = ''; $kol_rows = 0; $duplicate = '';
                    } else {
                        $gl_values .= ',';
                    }
                    //----------------Пишем в БД-----------------------------
                    /*

                    INSERT IGNORE INTO table1 (field1) VALUES ('C'),('D'),('E')
                    LOAD DATA INFILE

                    $sql = "INSERT INTO price (".$column_str.")
                                VALUES ".$gl_values.";
                                ON DUPLICATE KEY UPDATE
                                `_price`  = VALUES(`_price`),
                                `_count` =  VALUES(`_count`);";

                    $sql = "INSERT INTO price(".$column_str.")
                    VALUES(".$value_str.")
                    ON DUPLICATE KEY UPDATE
                    _price = '" . $masBD['_price'] . "',
                    _count = '" . $masBD['_count'] . "'";
                    $res = Yii::$app->db->createCommand($sql)->execute();
                    */
                }
            } else { echo '<pre>'; var_dump($model); die; }
        }

        $data_fn = time();
        return $this->render('load-price-from-file', [
            'error_mas' => $error_mas,
            'all_position' => $all_rows,//$num_str,
            'data_st' => $data_st,
            'data_fn' => $data_fn,
        ]);

    }

    protected function findModel($id)
    {
        if (($model = LoadpriceModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


}
