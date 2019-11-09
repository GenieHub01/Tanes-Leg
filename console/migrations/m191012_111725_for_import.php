<?php

use yii\db\Migration;

/**
 * Class m191012_111725_for_import
 */
class m191012_111725_for_import extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('goods', 'fuel_string', $this->string());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191012_111725_for_import cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191012_111725_for_import cannot be reverted.\n";

        return false;
    }
    */
}
