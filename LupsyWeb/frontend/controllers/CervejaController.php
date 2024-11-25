<?php

namespace frontend\controllers;

use common\models\Cerveja;
use common\models\Favorita;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CervejaController implements the CRUD actions for Cerveja model.
 */
class CervejaController extends Controller
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
     * Lists all Cerveja models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Cerveja::find()->where(['estado' => 1]),
            'pagination' => [
                'pageSize' => 50,
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ],
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cerveja model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = Cerveja::findOne($id);
        
        $isFavoritada = Favorita::find()
        ->where(['id_cerveja' => $id, 'id_utilizador' => Yii::$app->user->id])
        ->exists();

        return $this->render('view', [
            'model' => $model,
            'isFavoritada' => $isFavoritada,
        ]);
    }

    /**
     * Creates a new Cerveja model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */

    /**
     * Updates an existing Cerveja model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    

    /**
     * Deletes an existing Cerveja model.
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
     * Finds the Cerveja model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Cerveja the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cerveja::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionAddFavorito($id)
{
     // Verifica se o usuário está logado
     if (Yii::$app->user->isGuest) {
        return $this->redirect(['site/login']);
    }
    $id_user = Yii::$app->user->id;

    // Verifica se a cerveja já está nos favoritos
    $favorito = Favorita::findOne(['id_user' => $id_user, 'id_cerveja' => $id]);

    if ($favorito) {
        // Se já estiver nos favoritos, remove
        $favorito->delete();
        Yii::$app->session->setFlash('success', 'Cerveja removida dos favoritos.');
    } else {
        // Adiciona como favorito
        $novoFavorito = new Favorita();
        $novoFavorito->id_user = $id_user;
        $novoFavorito->id_cerveja = $id;
        if ($novoFavorito->save()) {
            Yii::$app->session->setFlash('success', 'Cerveja adicionada aos favoritos!');
        } else {
             // Captura e formata os erros para exibição
            $erros = implode('<br>', array_map(function($erro) {
                return implode(', ', $erro);
            }, $novoFavorito->getErrors()));
            Yii::$app->session->setFlash('error', "Falha ao adicionar aos favoritos. Erros: <br>$erros");
        }
    }

    // Redireciona de volta à página de visualização da cerveja
    return $this->redirect(['view', 'id' => $id]);
}
}
