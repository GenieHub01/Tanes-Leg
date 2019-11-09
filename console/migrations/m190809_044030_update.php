<?php

use yii\db\Migration;

/**
 * Class m190809_044030_update
 */
class m190809_044030_update extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn('user','token',$this->string(40)->notNull()->unique());
        $this->addColumn('user','role',$this->smallInteger(2)->notNull()->defaultValue(1));


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190809_044030_update cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190809_044030_update cannot be reverted.\n";

        return false;
    }
    */
}
