<?php

use yii\db\Migration;

/**
 * Class m241115_182212_update_estado_column_in_cerveja
 */
class m241115_182212_update_estado_column_in_cerveja extends Migration
{

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('{{%cerveja}}', 'estado', $this->integer()->notNull()->defaultValue(1));
        // Explanation:
        // - Changes `estado` to an integer column
        // - Sets `NOT NULL` constraint
        // - Sets the default value to `1` (assuming "Ativo")
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('{{%cerveja}}', 'estado', $this->integer());
        // Reverts `estado` to its previous state (removes `NOT NULL` and `defaultValue`).
    }
}