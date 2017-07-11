<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\FilesModel;
use app\modules\admin\models\LoadpriceModel;
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

        $model = new FilesModel();

        if (Yii::$app->request->isPost) {

            $model->file = UploadedFile::getInstance($model, 'file');

            if ($model->file && $model->validate()) {
                //$model->file->saveAs('images/'.$params['id'].'/' . $model->file->baseName . '.' . $model->file->extension);
                //$model->file->saveAs('images/ffffffffforbob' . $model->file->baseName . '.' . $model->file->extension);
                $data = \moonland\phpexcel\Excel::import( $model->file->tempName, [
                    'setFirstRecordAsKeys' => false, // if you want to set the keys of record column with first record, if it not set, the header with use the alphabet column on excel.
                    // 'setIndexSheetByName' => true, // set this if your excel data with multiple worksheet, the index of array will be set with the sheet name. If this not set, the index will use numeric.
                    //'getOnlySheet' => 'sheet1', // you can set this property if you want to get the specified sheet from the excel data with multiple worksheet.
                ]);
                /*
                                $data = \moonland\phpexcel\Excel::widget([
                                    'mode' => 'import',
                                    'fileName' => $fileName,
                                    'setFirstRecordAsKeys' => true, // if you want to set the keys of record column with first record, if it not set, the header with use the alphabet column on excel.
                                    'setIndexSheetByName' => true, // set this if your excel data with multiple worksheet, the index of array will be set with the sheet name. If this not set, the index will use numeric.
                                    'getOnlySheet' => 'sheet1', // you can set this property if you want to get the specified sheet from the excel data with multiple worksheet.
                                ]);
                */

               // foreach($data as $item){
               // }

            }
        }

        return $this->redirect(Yii::$app->request->referrer);

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
