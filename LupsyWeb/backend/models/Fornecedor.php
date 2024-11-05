<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fornecedor".
 *
 * @property int $id
 * @property string $nome
 * @property string|null $morada
 * @property string|null $nif
 * @property string|null $telefone
 *
 * @property Cerveja[] $cervejas
 */
class Fornecedor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fornecedor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome'], 'required'],
            [['nome', 'morada'], 'string', 'max' => 255],
            [['nif'], 'string', 'max' => 100],
            [['telefone'], 'string', 'max' => 50],
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
            'morada' => 'Morada',
            'nif' => 'Nif',
            'telefone' => 'Telefone',
        ];
    }

    /**
     * Gets query for [[Cervejas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCervejas()
    {
        return $this->hasMany(Cerveja::class, ['id_fornecedor' => 'id']);
    }
}
