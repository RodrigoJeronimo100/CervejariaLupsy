<?php

namespace frontend\models;

use common\models\Cerveja;
use common\models\Utilizador;
use Yii;

/**
 * This is the model class for table "historico_bebi".
 *
 * @property int $id
 * @property int|null $id_utilizador
 * @property int|null $id_cerveja
 * @property string|null $data
 *
 * @property Cerveja $cerveja
 * @property Utilizador $utilizador
 */
class HistoricoBebis extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'historico_bebi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_utilizador', 'id_cerveja'], 'integer'],
            [['data'], 'safe'],
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
            'data' => 'Data',
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
