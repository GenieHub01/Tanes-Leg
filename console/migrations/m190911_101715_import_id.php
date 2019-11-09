<?php

use yii\db\Migration;

/**
 * Class m190911_101715_import_id
 */
class m190911_101715_import_id extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createIndex('inx_goods_import_id','goods','import_id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190911_101715_import_id cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190911_101715_import_id cannot be reverted.\n";

        return false;
    }
    */
}
