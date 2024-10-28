<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "favorita".
 *
 * @property int $id
 * @property int|null $id_utilizador
 * @property int|null $id_cerveja
 * @property string|null $data_adicao
 *
 * @property Cerveja $cerveja
 * @property Utilizador $utilizador
 */
class Favorita extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'favorita';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_utilizador', 'id_cerveja'], 'integer'],
            [['data_adicao'], 'safe'],
            [['id_cerveja'], 'exist', 'skipOnError' => true, 'targetClass' => Cerveja::class, 'targetAttribute' => ['id_cerveja' => 'id']],
            [['id_utilizador'], 'exist', 'skipOnError' => true, 'targetClass' => Utilizador::class, 'targetAttribute' => ['id_utilizador' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_utilizador' => 'Id Utilizador',
            'id_cerveja' => 'Id Cerveja',
            'data_adicao' => 'Data Adicao',
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
     * Gets query for [[Utilizador]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUtilizador()
    {
        return $this->hasOne(Utilizador::class, ['id' => 'id_utilizador']);
    }
}
