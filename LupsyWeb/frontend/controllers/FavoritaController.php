<?php

namespace frontend\controllers;

use common\models\Favorita;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FavoritaController implements the CRUD actions for Favorita model.
 */
class FavoritaController extends Controller
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
                            'roles' => ['@'],
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
     * Lists all Favorita models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Favorita::find()->where(['id_utilizador' => Yii::$app->user->id]),
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
     * Displays a single Favorita model.
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
     * Creates a new Favorita model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($id_cerveja)
    {
        if (Yii::$app->user->isGuest || !Yii::$app->user->id) {
            return $this->redirect(['site/login']);
        }

        $model = new Favorita();
        $model->id_cerveja = $id_cerveja;
        $model->id_utilizador = Yii::$app->user->id; // Define o valor de id_utilizador com o ID do usuário autenticado

        $id_utilizador = Yii::$app->user->id;
        // Verifica se a cerveja já está favoritada pelo usuário
        $favoritaExistente = Favorita::findOne(['id_cerveja' => $id_cerveja, 'id_utilizador' => $id_utilizador]);

        if ($favoritaExistente) {
            // Desfavorita removendo o registro
            if ($favoritaExistente->delete()) {
                Yii::$app->session->setFlash('success', 'Cerveja removida dos favoritos com sucesso!');
            } else {
                Yii::$app->session->setFlash('error', 'Falha ao remover a cerveja dos favoritos.');
            }
            return $this->redirect(['cerveja/view', 'id' => $id_cerveja]);
    }
        $model = new Favorita();
        $model->id_cerveja = $id_cerveja;
        $model->id_utilizador = $id_utilizador; 

        if ($model->save()) {
            Yii::$app->session->setFlash('success', 'Cerveja favoritada com sucesso!');
            return $this->redirect(['cerveja/view', 'id' => $id_cerveja]);
        }
        $errors = $model->getErrors();
        Yii::$app->session->setFlash('error', 'Falha ao favoritar a cerveja.'. json_encode($errors));
        return $this->redirect(['cerveja/view', 'id' => $id_cerveja]);

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Favorita model.
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
     * Deletes an existing Favorita model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Favorita model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Favorita the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Favorita::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
