<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\CarsModel;
use yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class CarsController extends Controller
{
    public function actionIndex()
    {
        $model = new CarsModel();
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
        $model = new CarsModel();

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

    protected function findModel($id)
    {
        if (($model = CarsModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


}
