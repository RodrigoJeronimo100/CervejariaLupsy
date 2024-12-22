<?php

namespace backend\modules\api\controllers;

use backend\modules\api\models\UserInfoApi;
use common\models\Utilizador;
use Yii;
use yii\base\Controller;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;

class UtilizadorController extends ActiveController
{
    public $modelClass = 'common\models\Utilizador'; 

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['access'] = [
            'class' => \yii\filters\AccessControl::class,
            'rules' => [
                [
                    'allow' => true,
                    'actions' => ['update','view','create','index'], 
                    'roles' => ['?'],
                ],
                [
                    'allow' => false,
                    'actions' => ['delete'],  // Bloquear delete para todos
                ],
            ],
        ];
        return $behaviors;
    }
    public function actions()
    {
        $actions = parent::actions();
        // Desabilitar o delete
        unset($actions['delete']);
        return $actions;
    }
}