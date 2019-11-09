<?php

use yii\db\Migration;

/**
 * Class m190913_141908_user_options
 */
class m190913_141908_user_options extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user','first_name', $this->string()->notNull());
        $this->addColumn('user','last_name',$this->string()->notNull());
        $this->addColumn('user','shipping_address',$this->string() );
        $this->addColumn('user','shipping_address_optional',$this->string() );
        $this->addColumn('user','shipping_city',$this->string() );
        $this->addColumn('user','shipping_postcode',$this->string() );
        $this->addColumn('user','shipping_phone',$this->string() );



    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190913_141908_user_options cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190913_141908_user_options cannot be reverted.\n";

        return false;
    }
    */
}
