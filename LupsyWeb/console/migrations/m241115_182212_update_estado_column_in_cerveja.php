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
        if ($this->db->schema->getTableSchema('{{%cerveja}}')->getColumn('estado') === null) {
            $this->addColumn('{{%cerveja}}', 'estado', $this->integer()->notNull()->defaultValue(1));
        }
        // - Sets the default value to `1` (assuming "Ativo")
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%cerveja}}', 'estado');
    }
}