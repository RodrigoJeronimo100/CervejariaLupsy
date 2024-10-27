<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%categoria}}`.
 */
class m241022_225436_create_categoria_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%categoria}}', [
            'id' => $this->primaryKey(),
            'nome' => $this->string(255)->notNull(),
        ],'ENGINE=InnoDB');
    }

    public function safeDown()
    {
        $this->dropTable('{{%categoria}}');
    }
}
