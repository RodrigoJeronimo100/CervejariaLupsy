<?php 
namespace backend\modules\api\models;

use backend\models\Fornecedor;
use backend\models\Categoria;
use common\models\Cerveja as BaseCerveja;
use Yii;

class CervejaApi extends BaseCerveja
{
    // Campos personalizados para a API
    public $fornecedor_nome;
    public $categoria_nome; 


    public function fields()
    {
        return [
            'id',
            'nome',
            'descricao',
            'teor_alcoolico',
            'preco',
            'estado',
            'fornecedor_nome' => function ($model) {
                return $model->fornecedor ? $model->fornecedor->nome : null;
            },
            'categoria_nome' => function ($model) {
                return $model->categoria ? $model->categoria->nome : null;
            },
        ];
    }

    /**
     * Antes de salvar, converte o `fornecedor_nome` e `categoria_nome` em seus respectivos IDs.
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            // Converte o nome do fornecedor para o ID correspondente
            if (!empty($this->fornecedor_nome)) {
                $fornecedor = Fornecedor::findOne(['nome' => $this->fornecedor_nome]);
                if ($fornecedor) {
                    $this->id_fornecedor = $fornecedor->id;
                } else {
                    $this->addError('fornecedor_nome', 'Fornecedor não encontrado.');
                    return false;
                }
            }

            // Converte o nome da categoria para o ID correspondente
            if (!empty($this->categoria_nome)) {
                $categoria = Categoria::findOne(['nome' => $this->categoria_nome]);
                if ($categoria) {
                    $this->id_categoria = $categoria->id;
                } else {
                    $this->addError('categoria_nome', 'Categoria não encontrada.');
                    return false;
                }
            }

            $estado = Yii::$app->request->post('estado', $this->estado);
            if ($estado === 'ATIVO') {
                $this->estado = 1;
            } elseif ($estado === 'INATIVO') {
                $this->estado = 0;
            }else{
                $this->addError('estado', 'estado inválido utilize ATIVO ou INATIVO');
                return false;
            }

            return true;
        }
        return false;
    }

    /**
     * Define as regras de validação do modelo.
     */
    public function rules()
    {
        return [
            [['nome', 'descricao', 'teor_alcoolico', 'preco', 'estado'], 'required'],
            [['teor_alcoolico', 'preco'], 'number', 'min' => 0],
            [['estado'], 'string', 'max' => 20],
            [['nome', 'descricao', 'categoria_nome', 'fornecedor_nome'], 'string', 'max' => 255],
        ];
    }
    public static function getCategorias()
    {
        return Categoria::find()->all();
    }

    public static function getFornecedores()
    {
        return Fornecedor::find()->all();
    }
}
