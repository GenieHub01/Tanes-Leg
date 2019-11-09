<?php

use yii\db\Migration;

/**
 * Class m190917_093204_order_discount
 */
class m190917_093204_order_discount extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('order','promocodes_id', $this->integer());
        $this->addColumn('order','shipping_cost', $this->decimal(8,2));
        $this->addColumn('order','total_sum_discount', $this->decimal(8,2));



    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190917_093204_order_discount cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190917_093204_order_discount cannot be reverted.\n";

        return false;
    }
    */
}
