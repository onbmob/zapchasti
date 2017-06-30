<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\ClientModel;
use app\modules\admin\models\ClientSearch;
use yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class ClientController extends Controller
{
    public function actionIndex()
    {
        $model = new ClientSearch();
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
        $model = new ClientModel();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if($model->validate()) {
                $model->images = UploadedFile::getInstance($model, 'images');
                if ($model->images) {
                    $image_name = 'images/avatars/' . $model->id. '.png';
                    $model->images->saveAs($image_name);
                }
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
    /**
     * @param $id
     * @return ClientModel
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = ClientModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


}
