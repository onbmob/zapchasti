<?php
namespace app\modules\admin\controllers;

use app\modules\admin\models\MailAdressModel;
use Yii;
use app\models\MailSettingModel;
use yii\web\NotFoundHttpException;

class MailSettingController extends \yii\web\Controller{

    public function actionIndex(){
        $model = $this->findModel();

        return $this->render('index',[
            'model' => $model
        ]);
    }

    public function actionEditSetting(){
        $model = $this->findModel();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('index.php?r=admin/mail-setting');
        } else {
            return $this->render('settingForm', [
                'model' => $model,
            ]);
        }
    }

    public function actionGroupIndex(){
        $model = new MailAdressModel();
        $dataProviderModel = $model->search(Yii::$app->request->queryParams);

        return $this->render('groupIndex',[
            'dataProviderModel' => $dataProviderModel,
            'model' => $model
        ]);

    }

    /**
     * Creates a new MailAdressModel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MailAdressModel();

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
        $model = $this->findAdressModel($id);

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
    public function actionDelete($id){

        $this->findAdressModel($id)->delete();

        return $this->redirect(['group-index']);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findAdressModel($id),
        ]);
    }

    /**
     * @return MailSettingModel
     * @throws NotFoundHttpException
     */
    protected function findModel()
    {
        if (($model = MailSettingModel::findOne(1)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * @return MailAdressModel
     * @throws NotFoundHttpException
     */
    protected function findAdressModel($id)
    {
        if (($model = MailAdressModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
?>
