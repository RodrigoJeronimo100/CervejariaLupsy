<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "item_fatura".
 *
 * @property int $id
 * @property int|null $id_fatura
 * @property int|null $id_cerveja
 * @property int|null $quantidade
 * @property float|null $preco_unitario
 *
 * @property Cerveja $cerveja
 * @property Fatura $fatura
 */
class ItemFatura extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item_fatura';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_fatura', 'id_cerveja', 'quantidade'], 'integer'],
            [['preco_unitario'], 'number'],
            [['id_cerveja'], 'exist', 'skipOnError' => true, 'targetClass' => Cerveja::class, 'targetAttribute' => ['id_cerveja' => 'id']],
            [['id_fatura'], 'exist', 'skipOnError' => true, 'targetClass' => Fatura::class, 'targetAttribute' => ['id_fatura' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_fatura' => 'Id Fatura',
            'id_cerveja' => 'Id Cerveja',
            'quantidade' => 'Quantidade',
            'preco_unitario' => 'Preco Unitario',
        ];
    }

    /**
     * Gets query for [[Cerveja]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCerveja()
    {
        return $this->hasOne(Cerveja::class, ['id' => 'id_cerveja']);
    }

    /**
     * Gets query for [[Fatura]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFatura()
    {
        return $this->hasOne(Fatura::class, ['id' => 'id_fatura']);
    }
}
