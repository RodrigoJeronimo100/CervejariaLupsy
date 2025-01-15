<?php

namespace backend\modules\api\controllers;

use common\models\Fatura;
use Yii;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;

class FaturaController extends ActiveController
{
    public $modelClass = 'common\models\Fatura';
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
        ];
        return $behaviors;
    }
    public function actionPagar($id)
    {
        $model = $this->findModel($id);
        $model->estado = 'paga';
        if ($model->save()) {
            return ['success' => 'Fatura paga com sucesso.'];
        } else {
            return ['error'=> 'Erro ao pagar a fatura.'];
        }
    }
    protected function findModel($id)
    {
        if (($model = Fatura::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionHistorico(){
        $id_user = Yii::$app->user->id;    
        $faturas = Fatura::find()
        ->where(['id_utilizador' => $id_user])->all();
        return $faturas;
   }
}