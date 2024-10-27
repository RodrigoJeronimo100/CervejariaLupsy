<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%item_fatura}}`.
 */
class m241022_225812_create_item_fatura_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%item_fatura}}', [
            'id' => $this->primaryKey(),
            'id_fatura' => $this->integer(),
            'id_cerveja' => $this->integer(),
            'quantidade' => $this->integer(),
            'preco_unitario' => $this->decimal(10,2),
        ],'ENGINE=InnoDB');

     }

    public function safeDown()
    {
        // Deletar a tabela
        $this->dropTable('{{%item_fatura}}');
    }
}
