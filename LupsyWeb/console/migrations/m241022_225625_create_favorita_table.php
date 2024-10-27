<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%favorita}}`.
 */
class m241022_225625_create_favorita_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%favorita}}', [
            'id' => $this->primaryKey(),
            'id_utilizador' => $this->integer(),
            'id_cerveja' => $this->integer(),
            'data_adicao' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ],'ENGINE=InnoDB');

    }

    public function safeDown()
    {
         // Deletar a tabela
        $this->dropTable('{{%favorita}}');
    }
}
