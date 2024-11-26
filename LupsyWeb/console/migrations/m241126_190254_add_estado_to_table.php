<?php

use yii\db\Migration;

/**
 * Class m241126_190254_add_estado_to_table
 */
class m241126_190254_add_estado_to_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Adiciona a coluna "estado" à tabela
        $this->addColumn('{{%fatura}}', 'estado', "ENUM('aberta', 'paga', 'cancelada') DEFAULT 'aberta'");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Remove a coluna "estado"
        $this->dropColumn('{{%fatura}}', 'estado');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241126_190254_add_estado_to_table cannot be reverted.\n";

        return false;
    }
    */
}
