<?php

namespace backend\modules\api\controllers;

use backend\modules\api\models\CervejaApi;
use common\models\Favorita;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;

class FavoritaController extends ActiveController
{
    public $modelClass = 'common\models\Favorita';

    public function actionGetFavoritas($id_utilizador)
    {
        $favoritas = Favorita::findAll(['id_utilizador' => $id_utilizador]);

        $result = [];
        foreach ($favoritas as $favorita) {
            $cerveja = CervejaApi::findOne($favorita->id_cerveja);
            if ($cerveja) {
                $result[] = $cerveja;
            }
        }

        return $result;
    }
   
}