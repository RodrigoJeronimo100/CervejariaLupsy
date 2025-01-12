<?php

namespace backend\modules\api\controllers;

use common\models\Fatura;
use common\models\ItemFatura;
use Yii;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;


class ItemFaturaController extends ActiveController
{
    public $modelClass = 'common\models\ItemFatura';

    public function behaviors()
    {
       $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
        ];
        return $behaviors;
    }

    public function actions()
    {
        $actions = parent::actions();

        // Desabilitar ações desnecessárias
        unset($actions['create'], $actions['update'], $actions['delete']);

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
            $fatura->data_fatura = date('Y-m-d H:i:s'); // Definir data de criação
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
            return ['success' => 'Cerveja adicionada ao carrinho !'];
        }

        return ['errors' => $model->errors];
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $params = Yii::$app->getRequest()->getBodyParams();
        unset($params['id_fatura']); // Não permitir alterar a fatura associada
        $model->load($params, '');
        if ($model->save()) {
            // Atualizar o total da fatura associada
            if ($model->fatura) {
                $model->fatura->updateTotal();
            }
            return $model;
        }

        return ['errors' => $model->errors];
    }

    public function actionGetItemFatura()
    {
        $idUtilizador = Yii::$app->user->id;

        // Verificar se existe uma fatura com estado 'aberta' para este utilizador
        $fatura = Fatura::find()
            ->where(['id_utilizador' => $idUtilizador, 'estado' => 'aberta'])
            ->one();

        if (!$fatura) {
            return ['vazia' => 'Não existe uma fatura aberta para este utilizador.'];
        }

        // Obter todos os ItemFatura vinculados à fatura aberta
        $items = ItemFatura::find()
            ->where(['id_fatura' => $fatura->id])
            ->all();

        return $items;
    }

    protected function findModel($id)
    {
        if (($model = ItemFatura::findOne($id)) !== null) {
            return $model;
        }

        throw new \yii\web\NotFoundHttpException('The requested page does not exist.');
    }
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $fatura = $model->fatura;

        if ($model->delete()) {
            // Atualizar o total da fatura associada
            if ($fatura) {
                $fatura->updateTotal();
            }
            return  $this->asJson(['success' => 'Item removido da fatura.']);
        }

        return $this->asJson(['errors' => $model->errors]);
    }
   
}