<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%fornecedor}}`.
 */
class m241022_225659_create_fornecedor_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%fornecedor}}', [
            'id' => $this->primaryKey(),
            'nome' => $this->string(255)->notNull(),
            'morada' => $this->string(255),
            'nif' => $this->string(100),
            'telefone' => $this->string(50),
        ],'ENGINE=InnoDB');
    }

    public function safeDown()
    {
        $this->dropTable('{{%fornecedor}}');
    }
}
