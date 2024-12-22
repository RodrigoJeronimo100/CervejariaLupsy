<?php 

namespace backend\modules\api\controllers;

use Yii;
use backend\models\Categoria;
use backend\models\Fornecedor;
use backend\modules\api\models\CervejaApi;
use common\models\Cerveja;
use yii\rest\ActiveController;
use yii\web\Response;
use yii\web\NotFoundHttpException;

class CervejaController extends ActiveController
{
    public $modelClass = CervejaApi::class;
    //public $modelClass = 'common\models\Cerveja';

   // Método para permitir POST (criação) ou PUT (atualização)
   public function behaviors()
    {
        $behaviors = parent::behaviors();
        return $behaviors;
    }

    // Certifique-se de que a ação de update permite POST ou PUT
    public function actions()
    {
        $actions = parent::actions();
        // $actions['update'] = [
        //     'class' => 'backend\modules\api\controllers\CervejaController', // Define uma classe customizada para a ação
        //     'method' => 'actionUpdate', // Define o método a ser chamado para a ação de update
        // ];
        return $actions;
    }

    public function actionUpdate($id)
    {
        $cerveja = CervejaAPI::findOne($id);
        if (!$cerveja) {
            throw new NotFoundHttpException("Cerveja não encontrada.");
        }

        // Atualizando as informações com os dados recebidos
        $cerveja->nome = Yii::$app->request->post('nome', $cerveja->nome);
        $cerveja->descricao = Yii::$app->request->post('descricao', $cerveja->descricao);
        $cerveja->teor_alcoolico = Yii::$app->request->post('teor_alcoolico', $cerveja->teor_alcoolico);
        $cerveja->preco = Yii::$app->request->post('preco', $cerveja->preco);
        $cerveja->estado = Yii::$app->request->post('estado', $cerveja->estado);

        // Substituindo os nomes dos fornecedores e categorias pelos respectivos IDs
        $fornecedor_nome = Yii::$app->request->post('fornecedor_nome',$cerveja->fornecedor->nome);
        $categoria_nome = Yii::$app->request->post('categoria_nome');

        if ($fornecedor_nome) {
            $fornecedor = Fornecedor::find()->where(['nome' => $fornecedor_nome])->one();
            if ($fornecedor) {
                $cerveja->id_fornecedor = $fornecedor->id;
            }
        }else{
            $cerveja->id_fornecedor = Yii::$app->request->post('fornecedor_nome', $cerveja->id_fornecedor);
        }

        if ($categoria_nome) {
            $categoria = Categoria::find()->where(['nome' => $categoria_nome])->one();
            if ($categoria) {
                $cerveja->id_categoria = $categoria->id;
            }
        }else{
            $cerveja->id_categoria = Yii::$app->request->post('categoria_nome', $cerveja->id_categoria);
        }

        // Salvar as alterações
        if ($cerveja->save()) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $cerveja;
        }

        // Se não conseguir salvar, retorna erro
        return [
            'status' => 'erro',
            'message' => 'Não foi possível atualizar a cerveja.',
            'errors' => $cerveja->errors,
        ];
    }

}
