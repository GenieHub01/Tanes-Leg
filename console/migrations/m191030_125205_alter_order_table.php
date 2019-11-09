<?php

use yii\db\Migration;

/**
 * Class m191030_125205_alter_order_table
 */
class m191030_125205_alter_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
       $this->addColumn('order','wp_code', $this->string(256));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191030_125205_alter_order_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191030_125205_alter_order_table cannot be reverted.\n";

        return false;
    }
    */
}
