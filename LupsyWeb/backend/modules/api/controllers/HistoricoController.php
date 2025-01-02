<?php

namespace backend\modules\api\controllers;

use backend\modules\api\models\CervejaApi;
use common\models\HistoricoBebi;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;


class HistoricoController extends ActiveController
{
    public $modelClass = 'common\models\HistoricoBebi';
    
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
        ];
        return $behaviors;
    }

    public function actionGetHistorico($id_utilizador)
    {
        $historico = HistoricoBebi::findAll(['id_utilizador' => $id_utilizador]);

        $result = [];
        foreach ($historico as $registro) {
            $cerveja = CervejaApi::findOne($registro->id_cerveja);
            if ($cerveja) {
                $cervejaArray = $cerveja->toArray();
                $cervejaArray['data'] = $registro->data; // Adiciona o atributo data ao array
                $result[] = $cervejaArray;
            }
        }

        return $result;
    }
   
}