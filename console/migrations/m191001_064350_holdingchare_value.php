<?php

use yii\db\Migration;

/**
 * Class m191001_064350_holdingchare_value
 */
class m191001_064350_holdingchare_value extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('goods','holdingcharge', $this->decimal(8,2));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191001_064350_holdingchare_value cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191001_064350_holdingchare_value cannot be reverted.\n";

        return false;
    }
    */
}
