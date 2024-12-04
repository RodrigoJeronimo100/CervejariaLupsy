<?php

use yii\db\Migration;

/**
 * Class m241203_184549_comentario_table
 */
class m241203_184549_comentario_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%comentario}}', [
            'id' => $this->primaryKey(),
            'id_user' => $this->integer()->notNull(),
            'id_cerveja' => $this->integer()->notNull(),
            'comentario' => $this->text()->notNull(),
            'data' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        // Cria chaves estrangeiras para id_user e id_cerveja
        $this->addForeignKey(
            'fk-comentario-id_user',
            '{{%comentario}}',
            'id_user',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-comentario-id_cerveja',
            '{{%comentario}}',
            'id_cerveja',
            '{{%cerveja}}',
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
        // Remove as chaves estrangeiras
        $this->dropForeignKey('fk-comentario-id_user', '{{%comentario}}');
        $this->dropForeignKey('fk-comentario-id_cerveja', '{{%comentario}}');

        // Remove a tabela
        $this->dropTable('{{%comentario}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241203_184549_comentario_table cannot be reverted.\n";

        return false;
    }
    */
}
