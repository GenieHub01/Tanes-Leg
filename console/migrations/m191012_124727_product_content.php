<?php

use yii\db\Migration;

/**
 * Class m191012_124727_product_content
 */
class m191012_124727_product_content extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createIndex('inx_goods_title','goods','title');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191012_124727_product_content cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191012_124727_product_content cannot be reverted.\n";

        return false;
    }
    */
}
