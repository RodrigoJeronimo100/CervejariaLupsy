<?php

namespace backend\modules\api\controllers;

use frontend\models\SignupForm;
use Yii;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;


class SignupController extends ActiveController
{
    public $modelClass = 'frontend\models\SignupForm';
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
            'except' => ['create'], 
        ];
        return $behaviors;
    }
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create']); // Desabilitar a ação create padrão
        return $actions;
    }

    public function actionCreate()
    {
        $model = new SignupForm();
        $model->load(Yii::$app->request->post(), '');

        if ($model->validate() && $model->signup()) {
            return ['success' => 'Usuário registrado com sucesso!'];
        }

        return ['error' => $model->errors];
    }
   
}