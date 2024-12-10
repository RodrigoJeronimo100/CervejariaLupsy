<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%utilizador}}`.
 */
class m241022_230124_create_utilizador_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%utilizador}}', [
            'id' => $this->primaryKey(),
            'nome' => $this->string(255)->notNull(),
            'nif' => $this->string(100),
            'telefone' => $this->string(50),
            'morada' => $this->string(255),
            'id_user' => $this->integer()->notNull(),
        ], 'ENGINE=InnoDB');
    }

    public function safeDown()
    {
        $this->dropTable('{{%utilizador}}');
    }
}
