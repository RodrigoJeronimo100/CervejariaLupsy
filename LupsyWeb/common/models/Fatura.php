<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "fatura".
 *
 * @property int $id
 * @property int|null $id_utilizador
 * @property string|null $data_fatura
 * @property float|null $total
 * @property string|null $estado
 *
 * @property ItemFatura[] $itemFaturas
 * @property Utilizador $utilizador
 */
class Fatura extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fatura';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_utilizador'], 'integer'],
            [['data_fatura'], 'safe'],
            [['total'], 'number'],
            [['estado'], 'string'],
            [['id_utilizador'], 'exist', 'skipOnError' => true, 'targetClass' => Utilizador::class, 'targetAttribute' => ['id_utilizador' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID Fatura',
            'id_utilizador' => 'Id Utilizador',
            'data_fatura' => 'Data Fatura',
            'total' => 'Total',
            'estado' => 'Estado',
        ];
    }

    /**
     * Gets query for [[ItemFaturas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItemFaturas()
    {
        return $this->hasMany(ItemFatura::class, ['id_fatura' => 'id']);
    }

    /**
     * Gets query for [[Utilizador]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUtilizador()
    {
        return $this->hasOne(Utilizador::class, ['id' => 'id_utilizador']);
    }

    public function getTotalFatura()
    {
        $total = 0;

        foreach ($this->itemFaturas as $itemFatura) {
            $total += $itemFatura->quantidade * $itemFatura->preco_unitario;
        }

        return $total;
    }
    public function updateTotal()
    {
        $this->total = $this->getTotalFatura();
        $this->save(false);
    }
}
