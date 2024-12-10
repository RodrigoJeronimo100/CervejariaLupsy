<?php

namespace frontend\controllers;

use common\models\HistoricoBebi;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * HistoricoBebiController implements the CRUD actions for HistoricoBebi model.
 */
class HistoricoBebiController extends Controller
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
     * Lists all HistoricoBebi models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $userId = \Yii::$app->user->id; // Obter o ID do usuário logado

        // Consulta para obter a lista de cervejas e a quantidade consumida
        $query = (new \yii\db\Query())
            ->select(['cerveja.nome AS cerveja_nome', 'COUNT(*) AS total_consumed'])
            ->from('historico_bebi')
            ->innerJoin('cerveja', 'historico_bebi.id_cerveja = cerveja.id') // Ajuste o nome da tabela de cervejas conforme necessário
            ->where(['historico_bebi.id_utilizador' => $userId])
            ->groupBy('id_cerveja')
            ->orderBy(['total_consumed' => SORT_DESC]); // Ordena pela quantidade consumida, descendentemente
    
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $query->all(),
            'pagination' => [
                'pageSize' => 10, // Número de itens por página
            ],
        ]);
    
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single HistoricoBebi model.
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
     * Creates a new HistoricoBebi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $userId = Yii::$app->request->post('utilizador_id');
        $cervejaId = Yii::$app->request->post('cerveja_id');

        if ($userId && $cervejaId) {
            $historico = new HistoricoBebi();
            $historico->id_utilizador = $userId;
            $historico->id_cerveja = $cervejaId;

            if ($historico->save()) {
                return ['success' => true];
            }
        }

        return ['success' => false];
    }

    /**
     * Updates an existing HistoricoBebi model.
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
     * Deletes an existing HistoricoBebi model.
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
     * Finds the HistoricoBebi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return HistoricoBebi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = HistoricoBebi::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
