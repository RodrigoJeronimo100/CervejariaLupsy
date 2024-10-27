<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cerveja}}`.
 */
class m241022_225513_create_cerveja_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%cerveja}}', [
            'id' => $this->primaryKey(),
            'nome' => $this->string(255)->notNull(),
            'descricao' => $this->string(255),
            'teor_alcoolico' => $this->decimal(5,2),
            'preco' => $this->decimal(10,2),
            'id_fornecedor' => $this->integer(),
            'id_categoria' => $this->integer(),
        ],'ENGINE=InnoDB');

      }

    public function safeDown()
    {
         // Deletar a tabela
        $this->dropTable('{{%cerveja}}');
    }
}
