<?php

use yii\db\Migration;

/**
 * Class m241027_104136_add_foreiggn_keys_to_table
 */
class m241027_104136_add_foreiggn_keys_to_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Chaves estrangeiras para a tabela `avaliacao`
        // $this->addForeignKey(
        //     'fk-avaliacao-id_utilizador', 
        //     '{{%avaliacao}}', 
        //     'id_utilizador', 
        //     '{{%utilizador}}', 
        //     'id', 
        //     'CASCADE'
        // );

        // $this->addForeignKey(
        //     'fk-avaliacao-id_cerveja', 
        //     '{{%avaliacao}}', 
        //     'id_cerveja', 
        //     '{{%cerveja}}', 
        //     'id', 
        //     'CASCADE'
        // );

        // Chaves estrangeiras para a tabela `cerveja`
        $this->addForeignKey(
            'fk-cerveja-id_fornecedor', 
            '{{%cerveja}}', 
            'id_fornecedor', 
            '{{%fornecedor}}', 
            'id', 
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-cerveja-id_categoria', 
            '{{%cerveja}}', 
            'id_categoria', 
            '{{%categoria}}', 
            'id', 
            'CASCADE'
        );

        // Chave estrangeira para a tabela `fatura`
        $this->addForeignKey(
            'fk-fatura-id_utilizador', 
            '{{%fatura}}', 
            'id_utilizador', 
            '{{%utilizador}}', 
            'id', 
            'CASCADE'
        );

        // Chaves estrangeiras para a tabela `favorita`
        $this->addForeignKey(
            'fk-favorita-id_utilizador', 
            '{{%favorita}}', 
            'id_utilizador', 
            '{{%utilizador}}', 
            'id', 
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-favorita-id_cerveja', 
            '{{%favorita}}', 
            'id_cerveja', 
            '{{%cerveja}}', 
            'id', 
            'CASCADE'
        );

        // Chaves estrangeiras para a tabela `historico_bebi`
        $this->addForeignKey(
            'fk-historico_bebi-id_utilizador', 
            '{{%historico_bebi}}', 
            'id_utilizador', 
            '{{%utilizador}}', 
            'id', 
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-historico_bebi-id_cerveja', 
            '{{%historico_bebi}}', 
            'id_cerveja', 
            '{{%cerveja}}', 
            'id', 
            'CASCADE'
        );

        // Chaves estrangeiras para a tabela `item_fatura`
        $this->addForeignKey(
            'fk-item_fatura-id_fatura', 
            '{{%item_fatura}}', 
            'id_fatura', 
            '{{%fatura}}', 
            'id', 
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-item_fatura-id_cerveja', 
            '{{%item_fatura}}', 
            'id_cerveja', 
            '{{%cerveja}}', 
            'id', 
            'CASCADE'
        );

        // Chave estrangeira para a tabela `utilizador`
        $this->addForeignKey(
            'fk-utilizador-id_user',
            '{{%utilizador}}',
            'id_user',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-utilizador-id_user', '{{%utilizador}}');
        $this->dropForeignKey('fk-item_fatura-id_cerveja', '{{%item_fatura}}');
        $this->dropForeignKey('fk-item_fatura-id_fatura', '{{%item_fatura}}');
        $this->dropForeignKey('fk-historico_bebi-id_cerveja', '{{%historico_bebi}}');
        $this->dropForeignKey('fk-historico_bebi-id_utilizador', '{{%historico_bebi}}');
        $this->dropForeignKey('fk-favorita-id_cerveja', '{{%favorita}}');
        $this->dropForeignKey('fk-favorita-id_utilizador', '{{%favorita}}');
        $this->dropForeignKey('fk-fatura-id_utilizador', '{{%fatura}}');
        $this->dropForeignKey('fk-cerveja-id_categoria', '{{%cerveja}}');
        $this->dropForeignKey('fk-cerveja-id_fornecedor', '{{%cerveja}}');
        //$this->dropForeignKey('fk-avaliacao-id_cerveja', '{{%avaliacao}}');
        //$this->dropForeignKey('fk-avaliacao-id_utilizador', '{{%avaliacao}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241027_104136_add_foreiggn_keys_to_table cannot be reverted.\n";

        return false;
    }
    */
}
