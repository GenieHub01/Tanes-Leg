<?php

use yii\db\Migration;

/**
 * Class m191007_121716_goods_extracodes
 */
class m191007_121716_goods_extracodes extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn('goods','holdingcharge_id',$this->integer());
        $this->addColumn('goods','extra_shipping_id',$this->integer());
        $this->dropColumn('goods','holdingcharge' );
        $this->dropColumn('goods','extra_shipping' );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191007_121716_goods_extracodes cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191007_121716_goods_extracodes cannot be reverted.\n";

        return false;
    }
    */
}
