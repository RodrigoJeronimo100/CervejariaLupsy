<?php

namespace backend\controllers;

use common\models\User;
use common\models\Utilizador;
use frontend\models\SignupForm;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UtilizadorController implements the CRUD actions for Utilizador model.
 */
class UtilizadorController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'actions' => ['index', 'view'],
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                        [
                            'actions' => ['create', 'update', 'delete'],
                            'allow' => true,
                            'roles' => ['admin'],
                        ],
                    ],
                ],
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
     * Lists all Utilizador models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Utilizador::find(),
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
     * Displays a single Utilizador model.
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
     * Creates a new Utilizador model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new SignupForm();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->signup()) {
                $user = User::findByUsername($model->username);
                $auth = Yii::$app->authManager;

                Yii::$app->session->setFlash('success', 'Utilizador criado com sucesso!');
                return $this->redirect(['view', 'id' => $user->id]);
            } else {
                $errors = $model->getErrors();
                Yii::$app->session->setFlash('error', 'Falha ao criar o utilizador. Erros: ' . json_encode($errors));
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Utilizador model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Utilizador model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        // Inicia uma transação para garantir que ambos sejam deletados corretamente
        $transaction = Yii::$app->db->beginTransaction();
        try {
            // Encontra o modelo de Utilizador com base no ID
            $utilizador = $this->findModel($id);
    
            // Encontra o User associado ao Utilizador
            $user = User::findOne(['id' => $utilizador->id_user]);
    
            // Deleta o Utilizador primeiro
            if (!$utilizador->delete()) {
                // Se falhar ao deletar o Utilizador, faz o rollback
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', 'Falha ao excluir o Utilizador.');
                return $this->redirect(['index']);
            }
    
            // Agora deleta o User associado
            if ($user && !$user->delete()) {
                // Se falhar ao deletar o User, faz o rollback
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', 'Falha ao excluir o User.');
                return $this->redirect(['index']);
            }
    
            // Se tudo ocorreu bem, comita a transação
            $transaction->commit();
            Yii::$app->session->setFlash('success', 'Utilizador e User excluídos com sucesso.');
        } catch (\Exception $e) {
            // Se ocorrer um erro durante a transação, faz o rollback
            $transaction->rollBack();
            Yii::$app->session->setFlash('error', 'Erro ao excluir os dados. Tente novamente.');
        }
    
        return $this->redirect(['index']);
    }
    
    /**
     * Finds the Utilizador model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Utilizador the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Utilizador::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
