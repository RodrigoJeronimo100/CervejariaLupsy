<?php

namespace backend\modules\api\controllers;

use common\models\Fatura;
use common\models\ItemFatura;
use Yii;
use yii\rest\ActiveController;


class ItemFaturaController extends ActiveController
{
    public $modelClass = 'common\models\ItemFatura';

    public function actions()
    {
        $actions = parent::actions();

        // Desabilitar ações desnecessárias
        unset($actions['delete'], $actions['create'], $actions['update']);

        return $actions;
    }

    public function actionCreate()
    {
        $request = Yii::$app->request;
        $idUtilizador = Yii::$app->user->id;
        $idCerveja = $request->post('id_cerveja');
        $quantidade = $request->post('quantidade');
        $precoUni = $request->post('preco_unitario');

        // Verificar se existe uma fatura com estado 'aberta' para este utilizador
        $fatura = Fatura::find()
            ->where(['id_utilizador' => $idUtilizador, 'estado' => 'aberta'])
            ->one();

        // Se não existir, criar uma nova fatura
        if (!$fatura) {
            $fatura = new Fatura();
            $fatura->id_utilizador = $idUtilizador;
            $fatura->estado = 'aberta';
            $fatura->data_criacao = date('Y-m-d H:i:s'); // Definir data de criação
            if (!$fatura->save()) {
                return ['errors' => 'Não foi possível criar uma fatura.'];
            }
        }

        // Criar o ItemFatura vinculado à fatura
        $model = new ItemFatura();
        $model->id_fatura = $fatura->id;
        $model->id_cerveja = $idCerveja;
        $model->quantidade = $quantidade;
        $model->preco_unitario = $precoUni;

        if ($model->save()) {
            // Atualizar o total da fatura associada
            $fatura->updateTotal();
            return $model;
        }

        return ['errors' => $model->errors];
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        if ($model->save()) {
            // Atualizar o total da fatura associada
            if ($model->fatura) {
                $model->fatura->updateTotal();
            }
            return $model;
        }

        return ['errors' => $model->errors];
    }

    protected function findModel($id)
    {
        if (($model = ItemFatura::findOne($id)) !== null) {
            return $model;
        }

        throw new \yii\web\NotFoundHttpException('The requested page does not exist.');
    }
   
}