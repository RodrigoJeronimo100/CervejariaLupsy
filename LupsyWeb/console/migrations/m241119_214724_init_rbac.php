<?php

use yii\db\Migration;

/**
 * Class m241119_214724_init_rbac
 */
class m241119_214724_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        $admin = $auth->createRole('admin');
        $auth->add($admin);

        $utilizador = $auth->createRole('utilizador');
        $auth->add($utilizador);

        $auth->assign($admin, 1);
        $auth->assign($utilizador, 2);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241119_214724_init_rbac cannot be reverted.\n";

        return false;
    }
    */
}
