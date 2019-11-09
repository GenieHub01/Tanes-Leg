<?php

use yii\db\Migration;

/**
 * Class m190917_033933_goods_tx_id
 */
class m190917_033933_goods_tx_id extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('goods','tax_id', $this->smallInteger(3));
        $this->addColumn('goods','use_holdingcharge', $this->boolean());


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190917_033933_goods_tx_id cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190917_033933_goods_tx_id cannot be reverted.\n";

        return false;
    }
    */
}
