<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "comentario".
 *
 * @property int $id
 * @property int $id_user
 * @property int $id_cerveja
 * @property string $comentario
 * @property string|null $data
 */
class Comentario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comentario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'id_cerveja', 'comentario'], 'required'],
            [['id_user', 'id_cerveja'], 'integer'],
            [['comentario'], 'string'],
            [['data'], 'safe'],
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
            'id_cerveja' => 'Id Cerveja',
            'comentario' => 'Comentario',
            'data' => 'Data',
        ];
        
    }
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'id_user']);
    }
    public function getUtilizador()
    {
        return $this->hasOne(Utilizador::class, ['id_user' => 'id'])->via('user');
    }
}
