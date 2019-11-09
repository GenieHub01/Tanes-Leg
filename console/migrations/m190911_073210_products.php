<?php

use yii\db\Migration;

/**
 * Class m190911_073210_products
 */
class m190911_073210_products extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('goods',[
            'id'=>$this->primaryKey(),
            'title'=>$this->string(),
            'uri'=>$this->string(100),
            'import_id'=>$this->integer(),
            'description'=>$this->string(1000),
            'purchase_price'=>$this->decimal(8,2),
            'regular_price'=>$this->decimal(8,2),
            'sale_price'=>$this->decimal(8,2),
            'images'=>$this->json(),
            'category_id'=>$this->integer(),
            'brand'=>$this->string(), // todo maybe another table
            'model'=>$this->string(), // todo maybe another table
            'fuel'=>$this->smallInteger(2),
            'engine_type'=>$this->string(50),
            'add_info'=>$this->string(),
            'oem_exchange'=>$this->string(40),
            'engine_capacity'=>$this->decimal(2,1),
            'engine_power'=>$this->string(20),
            'part_number_list'=>$this->json( ),
            'comparison_number_list'=>$this->json( ),
            'sku'=>$this->string(30 ),
            'stock_status'=>$this->smallInteger(2 ),
            'tax_status'=>$this->smallInteger(2 ),
            'status'=>$this->smallInteger(2 ),
        ]);

        $this->createTable('category',[
            'id'=>$this->primaryKey(),
            'title'=>$this->string(100),
            'parent_id'=>$this->integer(),
            'position'=>$this->integer()->defaultValue(0)->notNull(),
        ]);

        $this->createIndex('inx_goods_category_id','goods','category_id');
        $this->addForeignKey('fk_inx_goods_category_id','goods','category_id','category','id','cascade','cascade');

        $this->createTable('years',[
            'year'=>$this->smallInteger(4)->unsigned(),
            'goods_id'=>$this->integer()
        ]);
        $this->addPrimaryKey('pk_years','years',['year','goods_id']);
        $this->addForeignKey('fk_pk_years','years','goods_id','goods','id');





    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190911_073210_products cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190911_073210_products cannot be reverted.\n";

        return false;
    }
    */
}
