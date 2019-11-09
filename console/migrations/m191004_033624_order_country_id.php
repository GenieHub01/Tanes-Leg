<?php

use yii\db\Migration;

/**
 * Class m191004_033624_order_country_id
 */
class m191004_033624_order_country_id extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn('order','country_id', $this->integer());
        $this->addColumn('user','country_id', $this->integer());
        $this->dropColumn('order','country' );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191004_033624_order_country_id cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191004_033624_order_country_id cannot be reverted.\n";

        return false;
    }
    */
}
