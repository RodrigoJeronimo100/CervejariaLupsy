<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%nota}}`.
 */
class m241203_193329_create_nota_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('nota', [
            'id' => $this->primaryKey(),
            'id_user' => $this->integer()->notNull(),
            'id_cerveja' => $this->integer()->notNull(),
            'nota' => $this->decimal(2, 1)->notNull()->check("nota >= 0 AND nota <= 5"), // Valores entre 0 e 5
        ],'ENGINE=InnoDB');

        // Chave estrangeira para id_user
        $this->addForeignKey(
            'fk-nota-id_user', // Nome da chave estrangeira
            'nota',            // Tabela atual
            'id_user',         // Coluna na tabela atual
            'user',            // Tabela referenciada
            'id',              // Coluna referenciada
            'CASCADE',         // Ação no DELETE
            'CASCADE'          // Ação no UPDATE
        );

        // Chave estrangeira para id_cerveja
        $this->addForeignKey(
            'fk-nota-id_cerveja', // Nome da chave estrangeira
            'nota',               // Tabela atual
            'id_cerveja',         // Coluna na tabela atual
            'cerveja',            // Tabela referenciada
            'id',                 // Coluna referenciada
            'CASCADE',            // Ação no DELETE
            'CASCADE'             // Ação no UPDATE
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Remoção das chaves estrangeiras
        $this->dropForeignKey('fk-nota-id_user', 'nota');
        $this->dropForeignKey('fk-nota-id_cerveja', 'nota');

        // Remoção da tabela
        $this->dropTable('nota');
    }
}
