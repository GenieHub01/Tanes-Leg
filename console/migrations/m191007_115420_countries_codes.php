<?php

use yii\db\Migration;

/**
 * Class m191007_115420_countries_codes
 */
class m191007_115420_countries_codes extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->dropColumn('countries','tax');
        $this->dropColumn('countries','shipping');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191007_115420_countries_codes cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191007_115420_countries_codes cannot be reverted.\n";

        return false;
    }
    */
}
