<?php

use yii\db\Migration;

/**
 * Class m191007_115257_countries_codes
 */
class m191007_115257_countries_codes extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn('countries','tax_id', $this->integer());
        $this->addColumn('countries','shipping_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191007_115257_countries_codes cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191007_115257_countries_codes cannot be reverted.\n";

        return false;
    }
    */
}
