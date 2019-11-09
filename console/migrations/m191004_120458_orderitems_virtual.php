<?php

use yii\db\Migration;

/**
 * Class m191004_120458_orderitems_virtual
 */
class m191004_120458_orderitems_virtual extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('order_items','holding_charge',$this->decimal(8,2));
        $this->addColumn('order_items','price_tax',$this->decimal(8,2));
        $this->addColumn('order_items','holding_charge_tax',$this->decimal(8,2));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191004_120458_orderitems_virtual cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191004_120458_orderitems_virtual cannot be reverted.\n";

        return false;
    }
    */
}
