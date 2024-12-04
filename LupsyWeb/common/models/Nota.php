<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "nota".
 *
 * @property int $id
 * @property int $id_user
 * @property int $id_cerveja
 * @property float $nota
 */
class Nota extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nota';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'id_cerveja', 'nota'], 'required'],
            [['id_user', 'id_cerveja'], 'integer'],
            [['nota'], 'number', 'min' => 0, 'max' => 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'nota' => 'Nota',
        ];
    }

    public function getCerveja()
    {
        return $this->hasOne(Cerveja::class, ['id' => 'id_cerveja']);
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'id_user']);
    }
}
