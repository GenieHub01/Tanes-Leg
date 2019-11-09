<?php

use yii\db\Migration;

/**
 * Class m190913_171839_user_options
 */
class m190913_171839_user_options extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('user','first_name', $this->string());
        $this->alterColumn('user','last_name',$this->string());


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190913_171839_user_options cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190913_171839_user_options cannot be reverted.\n";

        return false;
    }
    */
}
