<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%fatura}}`.
 */
class m241022_225552_create_fatura_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%fatura}}', [
            'id' => $this->primaryKey(),
            'id_utilizador' => $this->integer(),
            'data_fatura' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'total' => $this->decimal(10,2),
        ],'ENGINE=InnoDB');

     }

    public function safeDown()
    {
         // Deletar a tabela
        $this->dropTable('{{%fatura}}');
    }
}
