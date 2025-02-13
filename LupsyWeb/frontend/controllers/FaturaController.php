<?php

namespace frontend\controllers;

use common\models\Fatura;
use Mpdf\Mpdf;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FaturaController implements the CRUD actions for Fatura model.
 */
class FaturaController extends Controller
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
                            'actions' => ['index', 'view','pagar','delete','novo-pdf'],	
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
     * Lists all Fatura models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $userId = Yii::$app->user->id;

        $dataProvider = new ActiveDataProvider([
            'query' => Fatura::find()->where(['id_utilizador' => $userId]),
            'pagination' => [
                'pageSize' => 50,  // Defina o número de faturas por página, se necessário
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,  // Ordenar as faturas por ID em ordem decrescente
                ]
            ],
        ]);
    
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Fatura model.
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
     * Creates a new Fatura model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Fatura();

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
     * Updates an existing Fatura model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        // Verificar se o estado da fatura é 'aberta'
        if ($model->estado !== 'aberta') {
            Yii::$app->session->setFlash('error', 'Você só pode atualizar a fatura quando ela estiver aberta.');
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
     * Deletes an existing Fatura model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        // Verificar se o estado da fatura é 'aberta'
        if ($model->estado !== 'aberta') {
            Yii::$app->session->setFlash('error', 'Você só pode excluir a fatura quando ela estiver aberta.');
            return $this->redirect(['index']);
        }
    
        $model->delete();
    
        return $this->redirect(['index']);
    }

    /**
     * Finds the Fatura model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Fatura the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Fatura::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionPagar($id)
    {
        $model = $this->findModel($id);
        $model->estado = 'paga';
        if ($model->save()) {
            Yii::$app->session->setFlash('success', 'Fatura paga com sucesso.');
        } else {
            Yii::$app->session->setFlash('error', 'Erro ao pagar a fatura.');
        }
        return $this->redirect(['view', 'id' => $model->id]);
    }

    public function actionNovoPdf($id)
    {
        $fatura = Fatura::findOne($id);
        if (!$fatura) {
            throw new \yii\web\NotFoundHttpException("Fatura não encontrada.");
        }

        $items = $fatura->itemFaturas ?? [];

        $mpdf = new \Mpdf\Mpdf();
        $html = $this->renderPartial('pdf_template', [
            'fatura' => $fatura,
            'items' => $items
        ]);

        $mpdf->WriteHTML($html);

        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        Yii::$app->response->headers->add('Content-Type', 'application/pdf');
        Yii::$app->response->headers->add('Content-Disposition', 'attachment; filename="Fatura_' . $fatura->id . '.pdf"');

        return $mpdf->Output('Fatura_' . $fatura->id . '.pdf', 'D'); // 'D' força o download
    }



}
