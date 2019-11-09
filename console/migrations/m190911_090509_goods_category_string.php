<?php

use yii\db\Migration;

/**
 * Class m190911_090509_goods_category_string
 */
class m190911_090509_goods_category_string extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('goods','category_string', $this->string(100));
        $this->addColumn('goods','years_string', $this->string(100));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190911_090509_goods_category_string cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190911_090509_goods_category_string cannot be reverted.\n";

        return false;
    }
    */
}
