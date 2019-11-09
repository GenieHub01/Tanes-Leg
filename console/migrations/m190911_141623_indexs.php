<?php

use yii\db\Migration;

/**
 * Class m190911_141623_indexs
 */
class m190911_141623_indexs extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createIndex('inx_goods_engine_capacity','goods','engine_capacity');
        $this->createIndex('inx_goods_brand','goods','brand');
        $this->createIndex('inx_goods_model','goods','model');


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190911_141623_indexs cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190911_141623_indexs cannot be reverted.\n";

        return false;
    }
    */
}
