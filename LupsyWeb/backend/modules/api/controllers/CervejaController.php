<?php 

namespace backend\modules\api\controllers;

use Yii;
use backend\models\Categoria;
use backend\models\Fornecedor;
use backend\modules\api\models\CervejaApi;
use common\models\Cerveja;
use common\models\Favorita;
use common\models\Nota;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;
use yii\web\BadRequestHttpException;
use yii\web\Response;
use yii\web\NotFoundHttpException;

class CervejaController extends ActiveController
{
    public $modelClass = CervejaApi::class;
    //public $modelClass = 'common\models\Cerveja';

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
        return $actions;
    }
    public function actionCategorias()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return CervejaApi::getCategorias();
    }

    public function actionFornecedores()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return CervejaApi::getFornecedores();
    }
    public function actionFavoritar($id)
    {
        if (Yii::$app->user->isGuest) {
            return ['error' => 'Usuário não autenticado.'];
        }

        $id_user = Yii::$app->user->id;

        // Verifica se a cerveja já está nos favoritos
        $favorito = Favorita::findOne(['id_utilizador' => $id_user, 'id_cerveja' => $id]);

        if ($favorito) {
            // Se já estiver nos favoritos, remove
            if ($favorito->delete()) {
                return ['success' => 'Cerveja removida dos favoritos.'];
            } else {
                return ['error' => 'Falha ao remover dos favoritos.'];
            }
        } else {
            // Adiciona como favorito
            $novoFavorito = new Favorita();
            $novoFavorito->id_utilizador = $id_user;
            $novoFavorito->id_cerveja = $id;
            if ($novoFavorito->save()) {
                return ['success' => 'Cerveja adicionada aos favoritos!'];
            } else {
                // Captura e formata os erros para exibição
                $erros = implode(', ', array_map(function($erro) {
                    return implode(', ', $erro);
                }, $novoFavorito->getErrors()));
                return ['error' => "Falha ao adicionar aos favoritos. Erros: $erros"];
            }
        }
    }
    public function actionVotar($id)
    {
       // Verifica se o usuário está logado
        if (Yii::$app->user->isGuest) {
            return ['error' => 'Usuário não autenticado.'];
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
            'id_utilizador' => Yii::$app->user->id,
            'id_cerveja' => $id,
        ]) ?? new Nota();

        $notaModel->id_utilizador = Yii::$app->user->id;
        $notaModel->id_cerveja = $id;
        $notaModel->nota = $nota;

        if ($notaModel->save()) {
            return ['success' => 'Nota registrada com sucesso.'];
        } else {
            // Captura e formata os erros para exibição
            $erros = implode(', ', array_map(function($erro) {
                return implode(', ', $erro);
            }, $notaModel->getErrors()));
            return ['error' => "Falha ao registrar a nota. Erros: $erros"];
        }
    }

    public function actionNota($id)
    {
        // Busca a cerveja
        $cerveja = Cerveja::findOne($id);
        if (!$cerveja) {
            throw new NotFoundHttpException('Cerveja não encontrada.');
        }

        // Busca todas as notas da cerveja
        $notas = Nota::find()->where(['id_cerveja' => $id])->all();

        if (empty($notas)) {
            return ['nota_media' => 0];
        }

        // Calcula a média das notas
        $somaNotas = array_sum(array_column($notas, 'nota'));
        $mediaNotas = $somaNotas / count($notas);

        return ['nota_media' => $mediaNotas];
    }

    public function actionIsFavorito($id)
    {
        if (Yii::$app->user->isGuest) {
            return ['is_favorito' => false];
        }

        $id_user = Yii::$app->user->id;

        // Verifica se a cerveja está nos favoritos
        $favorito = Favorita::findOne(['id_utilizador' => $id_user, 'id_cerveja' => $id]);

        if ($favorito) {
            return true;
        } else {
            return false;
        }
    }
}
