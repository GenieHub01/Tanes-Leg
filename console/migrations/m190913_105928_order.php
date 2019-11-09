<?php

use yii\db\Migration;

/**
 * Class m190913_105928_order
 */
class m190913_105928_order extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createTable('order',[
            'id'=>$this->primaryKey(),
            'first_name'=>$this->string()->notNull(),
            'last_name'=>$this->string()->notNull(),
            'company_name'=>$this->string(),
            'note'=>$this->string(250),
            'admin_note'=>$this->string(250),
            'country'=>$this->string()->notNull(),
            'address'=>$this->string()->notNull(),
            'address_optional'=>$this->string(),
            'city'=>$this->string()->notNull(),
            'postcode'=>$this->string(40),
            'phone'=>$this->string(40),
            'email'=>$this->string(40),
            'total_sum'=>$this->decimal(8,2),
            'created_ts'=>$this->integer(),
            'updated_ts'=>$this->integer(),
            'status'=>$this->smallInteger(3)
        ]);

        $this->createTable('order_items',[
            'id'=>$this->primaryKey(),
            'order_id'=>$this->integer(),
            'goods_id'=>$this->integer(),
            'count'=>$this->integer(),
            'price'=>$this->decimal(8,2),

        ]);

        $this->createIndex('inx_order_items_order_id','order_items','order_id');
        $this->addForeignKey('fk_inx_order_items_order_id','order_items','order_id','order','id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190913_105928_order cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190913_105928_order cannot be reverted.\n";

        return false;
    }
    */
}
