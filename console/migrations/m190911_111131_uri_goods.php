<?php

use yii\db\Migration;

/**
 * Class m190911_111131_uri_goods
 */
class m190911_111131_uri_goods extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('goods','uri',$this->string(255));
        $this->alterColumn('goods','engine_capacity',$this->string(50));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190911_111131_uri_goods cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190911_111131_uri_goods cannot be reverted.\n";

        return false;
    }
    */
}
