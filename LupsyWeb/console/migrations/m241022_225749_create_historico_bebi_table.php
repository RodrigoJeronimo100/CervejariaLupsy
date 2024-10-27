<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%historico_bebi}}`.
 */
class m241022_225749_create_historico_bebi_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%historico_bebi}}', [
            'id' => $this->primaryKey(),
            'id_utilizador' => $this->integer(),
            'id_cerveja' => $this->integer(),
            'data' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ],'ENGINE=InnoDB');
    }

    public function safeDown()
    {
       // Deletar a tabela
        $this->dropTable('{{%historico_bebi}}');
    }
}
