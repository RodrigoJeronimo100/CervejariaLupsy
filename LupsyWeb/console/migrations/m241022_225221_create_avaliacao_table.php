<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%avaliacao}}`.
 */
class m241022_225221_create_avaliacao_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%avaliacao}}', [
            'id' => $this->primaryKey(),
            'id_utilizador' => $this->integer(),
            'id_cerveja' => $this->integer(),
            'nota' => $this->integer(),
            'comentario' => $this->string(250),
            'data_avaliacao' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ],'ENGINE=InnoDB');

    }

    public function safeDown()
    {
        // Deletar a tabela
        $this->dropTable('{{%avaliacao}}');
    }
}

