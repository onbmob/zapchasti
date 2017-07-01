<?php
namespace app\modules\admin\controllers;

use app\modules\admin\models\RegionModel;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class RegionController extends Controller
{
    public function actionIndex()
    {
        $model = new RegionModel();
        $dataProviderModel = $model->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'dataProviderModel' => $dataProviderModel,
            'model' => $model
        ]);

    }

    public function actionCreate()
    {
        $model = new RegionModel();

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
        $model = $this->findRegionModel($id);

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
        $this->findRegionModel($id)->delete();
        return $this->redirect(['index']);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findRegionModel($id),
        ]);
    }

    /**
     * @param $id
     * @return RegionModel
     * @throws NotFoundHttpException
     */

    protected function findRegionModel($id)
    {
        if (($model = RegionModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

?>
