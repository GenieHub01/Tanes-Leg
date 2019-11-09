<?php

use yii\db\Migration;

/**
 * Class m190930_091251_countries
 */
class m190930_091251_countries extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createTable('countries',[
            'id'=>$this->primaryKey(),
            'title'=>$this->string(100),
            'shortcode'=>$this->string(10),
            'tax'=>$this->integer(3),
            'shipping'=>$this->decimal(8,2),
            'created_ts'=>$this->integer(),
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190930_091251_countries cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190930_091251_countries cannot be reverted.\n";

        return false;
    }
    */
}
