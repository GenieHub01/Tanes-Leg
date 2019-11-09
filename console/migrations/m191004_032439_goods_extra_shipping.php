<?php

use yii\db\Migration;

/**
 * Class m191004_032439_goods_extra_shipping
 */
class m191004_032439_goods_extra_shipping extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn('goods','extra_shipping', $this->decimal(8,2));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191004_032439_goods_extra_shipping cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191004_032439_goods_extra_shipping cannot be reverted.\n";

        return false;
    }
    */
}
