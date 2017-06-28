<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use app\modules\loger\models\auchlog;
use app\modules\loger\models\UserIPModel;

class UserController extends \yii\web\Controller
{
    public function actionUserAuth()
    {
        $model = new auchlog;
        $dataProviderModel = $model->search(Yii::$app->request->queryParams);

        return $this->render('UserAuth',[
            'dataProviderModel' => $dataProviderModel,
            'model' => $model
        ]);
    }

    public function actionUsers(){
        $model = new UserIPModel;
        $dataProviderModel = $model->search(Yii::$app->request->queryParams);
        return $this->render('Users',[
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
        $model = new UserIPModel();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
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

        return $this->redirect(['users']);
    }

    /**
     * @param $id
     * @return UserIPModel
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = UserIPModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
