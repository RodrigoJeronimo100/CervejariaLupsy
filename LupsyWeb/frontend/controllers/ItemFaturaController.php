<?php

namespace frontend\controllers;

use common\models\Fatura;
use common\models\ItemFatura;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\ServerErrorHttpException;

/**
 * ItemFaturaController implements the CRUD actions for ItemFatura model.
 */
class ItemFaturaController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all ItemFatura models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => ItemFatura::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ItemFatura model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ItemFatura model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    // public function actionCreate()
    // {
    //     // Obter o ID do utilizador logado
    //     $idUtilizador = Yii::$app->user->id;
    
    //     // Verificar se existe uma fatura com estado 'aberta' para este utilizador
    //     $fatura = Fatura::find()
    //         ->where(['id_utilizador' => $idUtilizador, 'estado' => 'aberta'])
    //         ->one();
    
    //     // Se não existir, criar uma nova fatura
    //     if (!$fatura) {
    //         $fatura = new Fatura();
    //         $fatura->id_utilizador = $idUtilizador;
    //         $fatura->estado = 'aberta';
    //         $fatura->data_criacao = date('Y-m-d H:i:s'); // Definir data de criação
    //         if (!$fatura->save()) {
    //             Yii::$app->session->setFlash('error', 'Não foi possível criar uma fatura.');
    //             return $this->redirect(['fatura/index']); // Redirecionar para index fatura
    //         }
    //     }
    
    //     // Criar o ItemFatura vinculado à fatura
    //     $model = new ItemFatura();
    //     $model->fatura_id = $fatura->id;
    
    //     if ($this->request->isPost) {
    //         if ($model->load($this->request->post()) && $model->save()) {
    //             Yii::$app->session->setFlash('success', 'Item adicionado à fatura com sucesso.');
    //             return $this->redirect(['view', 'id' => $model->id]);
    //         }
    //     } else {
    //         $model->loadDefaultValues();
    //     }
    
    //     return $this->render('create', [
    //         'model' => $model,
    //     ]);
    // }
    public function actionCreate()
{
    $request = Yii::$app->request;
    $idCerveja = $request->post('id_cerveja');
    $quantidade = $request->post('quantidade');
    $precoUni = $request->post('preco');

    if (!$idCerveja || !$quantidade || !$precoUni) {
        throw new BadRequestHttpException("Dados inválidos.");
    }

    // Verificar se existe uma fatura aberta para o usuário logado
    $userId = Yii::$app->user->id;
    $fatura = Fatura::find()
        ->where(['id_utilizador' => $userId, 'estado' => 'aberta'])
        ->one();

    if (!$fatura) {
        // Criar uma nova fatura se não existir
        $fatura = new Fatura([
            'id_utilizador' => $userId,
            'estado' => 'aberta',
        ]);
        if (!$fatura->save()) {
            throw new ServerErrorHttpException("Erro ao criar fatura.");
        }
    }

    // Criar o item da fatura
    $itemFatura = new ItemFatura([
        'id_fatura' => $fatura->id,
        'id_cerveja' => $idCerveja,
        'quantidade' => $quantidade,
        'preco_unitario' => $precoUni,
    ]);

    if ($itemFatura->save()) {
        return $this->redirect(['/fatura/view', 'id' => $fatura->id]);
    } else {
        return $this->render('create', ['model' => $itemFatura]);
    }
}


    /**
     * Updates an existing ItemFatura model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        // Verificar se a fatura associada está com o estado 'aberta'
        if ($model->fatura->estado !== 'aberta') {
            Yii::$app->session->setFlash('error', 'Você só pode atualizar os itens quando a fatura estiver aberta.');
            return $this->redirect(['view', 'id' => $model->id]);
        }
    
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
    
        return $this->render('update', [
            'model' => $model,
        ]);
    }
    /**
     * Deletes an existing ItemFatura model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        // Verificar se a fatura associada está com o estado 'aberta'
        if ($model->fatura->estado !== 'aberta') {
            Yii::$app->session->setFlash('error', 'Você só pode excluir os itens quando a fatura estiver aberta.');
            return $this->redirect(['view', 'id' => $model->id]);
        }
    
        $model->delete();
    
        return $this->redirect(['index']);
    }

    /**
     * Finds the ItemFatura model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return ItemFatura the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ItemFatura::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
