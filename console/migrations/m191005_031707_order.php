<?php

use yii\db\Migration;

/**
 * Class m191005_031707_order
 */
class m191005_031707_order extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('order','total_tax', $this->decimal(8,2));
        $this->addColumn('order','total_tax_discount', $this->decimal(8,2));
        $this->addColumn('order','tax_percent', $this->integer());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191005_031707_order cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191005_031707_order cannot be reverted.\n";

        return false;
    }
    */
}
