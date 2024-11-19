<?php

namespace common\models;

use frontend\models\Avaliacao;
use frontend\models\HistoricoBebis;
use Yii;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "utilizador".
 *
 * @property int $id
 * @property string $nome
 * @property string|null $nif
 * @property string|null $telefone
 * @property string|null $morada
 * @property int $id_user
 *
 * @property Avaliacao[] $avaliacaos
 * @property Fatura[] $faturas
 * @property Favorita[] $favoritas
 * @property HistoricoBebi[] $historicoBebis
 * @property User $user
 */
class Utilizador extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'utilizador';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'id_user'], 'required'],
            [['id_user'], 'integer'],
            [['nome', 'morada'], 'string', 'max' => 255],
            [['nif'], 'string', 'max' => 100],
            [['telefone'], 'string', 'max' => 50],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_user' => 'id']],
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
            'nif' => 'Nif',
            'telefone' => 'Telefone',
            'morada' => 'Morada',
            'id_user' => 'Id User',
        ];
    }

    /**
     * Gets query for [[Avaliacaos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAvaliacaos()
    {
        return $this->hasMany(Avaliacao::class, ['id_utilizador' => 'id']);
    }

    /**
     * Gets query for [[Faturas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFaturas()
    {
        return $this->hasMany(Fatura::class, ['id_utilizador' => 'id']);
    }

    /**
     * Gets query for [[Favoritas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFavoritas()
    {
        return $this->hasMany(Favorita::class, ['id_utilizador' => 'id']);
    }

    /**
     * Gets query for [[HistoricoBebis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHistoricoBebis()
    {
        return $this->hasMany(HistoricoBebis::class, ['id_utilizador' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'id_user']);
    }
}
