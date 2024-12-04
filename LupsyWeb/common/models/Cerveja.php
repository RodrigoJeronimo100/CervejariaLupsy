<?php

namespace common\models;

use common\models\Comentario;
use backend\models\Categoria;
use backend\models\Fornecedor;
use frontend\models\Avaliacao;
use frontend\models\HistoricoBebi;
use Yii;

/**
 * This is the model class for table "cerveja".
 *
 * @property int $id
 * @property string $nome
 * @property string|null $descricao
 * @property float|null $teor_alcoolico
 * @property float|null $preco
 * @property int|null $estado
 * @property int|null $id_fornecedor
 * @property int|null $id_categoria
 *
 * @property Avaliacao[] $avaliacaos
 * @property Categoria $categoria
 * @property Favorita[] $favoritas
 * @property Fornecedor $fornecedor
 * @property HistoricoBebi[] $historicoBebi
 * @property ItemFatura[] $itemFaturas
 * @property Comentario[] $comentario
 */
class Cerveja extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cerveja';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome'], 'required'],
            [['teor_alcoolico', 'preco'], 'number'],
            [['id_fornecedor', 'id_categoria'], 'integer'],
            [['nome', 'descricao'], 'string', 'max' => 255],
            [['estado'],'boolean'],
            [['id_categoria'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::class, 'targetAttribute' => ['id_categoria' => 'id']],
            [['id_fornecedor'], 'exist', 'skipOnError' => true, 'targetClass' => Fornecedor::class, 'targetAttribute' => ['id_fornecedor' => 'id']],
           
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'descricao' => 'Descricao',
            'teor_alcoolico' => 'Teor Alcoolico',
            'preco' => 'Preco',
            'estado' => 'Estado',
            'id_fornecedor' => 'Id Fornecedor',
            'id_categoria' => 'Id Categoria',
        ];
    }

    /**
     * Gets query for [[Avaliacaos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAvaliacaos()
    {
        return $this->hasMany(Avaliacao::class, ['id_cerveja' => 'id']);
    }

    /**
     * Gets query for [[Categoria]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Categoria::class, ['id' => 'id_categoria']);
    }

    /**
     * Gets query for [[Favoritas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFavoritas()
    {
        return $this->hasMany(Favorita::class, ['id_cerveja' => 'id']);
    }

    /**
     * Gets query for [[Fornecedor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFornecedor()
    {
        return $this->hasOne(Fornecedor::class, ['id' => 'id_fornecedor']);
    }

    /**
     * Gets query for [[HistoricoBebi]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHistoricoBebis()
    {
        return $this->hasMany(HistoricoBebi::class, ['id_cerveja' => 'id']);
    }

    /**
     * Gets query for [[ItemFaturas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItemFaturas()
    {
        return $this->hasMany(ItemFatura::class, ['id_cerveja' => 'id']);
    }

    public function getComentarios()
    {
        return $this->hasMany(Comentario::class, ['id_cerveja' => 'id']);
    }
}
