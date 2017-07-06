<?php
namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\CrossDbModel;
use yii\web\NotFoundHttpException;

class CrossDbController extends \yii\web\Controller{

    public function actionIndex(){
        $model = $this->findModel();

        return $this->render('index',[
            'model' => $model
        ]);
    }

    public function actionEditSetting(){
        $model = $this->findModel();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('index.php?r=admin/cross-db');
        } else {
            return $this->render('settingForm', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    protected function findModel()
    {
        if (($model = CrossDbModel::findOne(1)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
?>
