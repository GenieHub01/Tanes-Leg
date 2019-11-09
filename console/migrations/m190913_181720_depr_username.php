<?php

use yii\db\Migration;

/**
 * Class m190913_181720_depr_username
 */
class m190913_181720_depr_username extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {


        $this->alterColumn('user','username', $this->string());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190913_181720_depr_username cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190913_181720_depr_username cannot be reverted.\n";

        return false;
    }
    */
}
