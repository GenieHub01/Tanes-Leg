<?php

use yii\db\Migration;

/**
 * Class m190913_131740_order_user_id
 */
class m190913_131740_order_user_id extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('order','user_id', $this->integer());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190913_131740_order_user_id cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190913_131740_order_user_id cannot be reverted.\n";

        return false;
    }
    */
}
