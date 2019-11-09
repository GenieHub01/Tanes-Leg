<?php

use yii\db\Migration;

/**
 * Class m190913_131316_order_anonim
 */
class m190913_131316_order_anonim extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('order','md5_link', $this->string(40));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190913_131316_order_anonim cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190913_131316_order_anonim cannot be reverted.\n";

        return false;
    }
    */
}
