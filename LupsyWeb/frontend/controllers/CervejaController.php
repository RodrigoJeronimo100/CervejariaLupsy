<?php

namespace frontend\controllers;

use common\models\Cerveja;
use common\models\Comentario;
use common\models\Favorita;
use common\models\Nota;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;

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
         // Captura o filtro de categoria da requisição GET
        $id_categoria = Yii::$app->request->get('categoria'); // 'todas' é o valor padrão
        
        // Inicia a consulta
        $query = Cerveja::find();

        // Se não for 'todas', aplica o filtro pela categoria
        if ($id_categoria !== "") {
            $query->andWhere(['id_categoria' => $id_categoria]); // Ajuste o nome do campo conforme seu banco de dados
        }

        // Cria o DataProvider com a consulta filtrada
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10, // Ajuste o número de itens por página conforme necessário
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC, // Ordena por ID de forma decrescente
                ]
            ]
        ]);

        // Passa o dataProvider para a view
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'id_categoria' => $id_categoria, // Passando o valor de categoria para a view
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
        if (!$model) {
            throw new NotFoundHttpException('A cerveja solicitada não foi encontrada.');
        }

        $novoComentario = new Comentario();
        $comentarios = $model->getComentarios()->orderBy(['data' => SORT_DESC])->all();
        $mediaNota = $this->calcularMediaNota($id);

        $isFavoritada = Favorita::find()
        ->where(['id_cerveja' => $id, 'id_utilizador' => Yii::$app->user->id])
        ->exists();

        return $this->render('view', [
            'model' => $model,
            'isFavoritada' => $isFavoritada,
            'comentarios' => $comentarios,
            'novoComentario' => $novoComentario,
            'mediaNota' => $mediaNota,
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

    public function actionRate($id)
    {
        // Verifica se o usuário está logado
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }
    
        // Busca a cerveja
        $cerveja = Cerveja::findOne($id);
        if (!$cerveja) {
            throw new NotFoundHttpException('Cerveja não encontrada.');
        }
    
        // Recebe a nota enviada
        $nota = Yii::$app->request->post('nota');
        if (!$nota || $nota < 0.5 || $nota > 5) {
            throw new BadRequestHttpException('Nota inválida.');
        }
    
        // Salva ou atualiza a nota do usuário
        $notaModel = Nota::findOne([
            'id_user' => Yii::$app->user->id,
            'id_cerveja' => $id,
        ]) ?? new Nota();
    
        $notaModel->id_user = Yii::$app->user->id;
        $notaModel->id_cerveja = $id;
        $notaModel->nota = $nota;
    
        if ($notaModel->save()) {
            Yii::$app->session->setFlash('success', 'Sua nota foi salva com sucesso!');
        } else {
            Yii::$app->session->setFlash('error', 'Não foi possível salvar sua nota.');
        }
    
        return $this->redirect(['cerveja/view', 'id' => $id]);
    }
    
    private function calcularMediaNota($idCerveja)
    {
        // Buscar todas as notas associadas à cerveja
        $notas = Nota::find()->where(['id_cerveja' => $idCerveja])->all();
        
        // Se não houver notas, retorna 0
        if (count($notas) === 0) {
            return 0;
        }

        // Somar todas as notas
        $somaNotas = array_sum(ArrayHelper::getColumn($notas, 'nota'));
        
        // Calcular e retornar a média
        return number_format($somaNotas / count($notas), 1);
    }

}
