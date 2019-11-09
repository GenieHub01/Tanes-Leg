<?php

use yii\db\Migration;

/**
 * Class m190917_035630_promocodes
 */
class m190917_035630_promocodes extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createTable('promocodes',[
            'id'=>$this->primaryKey(),
            'code'=>$this->string(40)->notNull(),
            'start_date'=>$this->date(),
            'end_date'=>$this->date(),
            'percent'=>$this->integer(),
            'created_ts'=>$this->integer(),
            'updated_ts'=>$this->integer(),
            'sum'=>$this->decimal(8,2),
            'minorder_sum'=>$this->decimal(8,2),
            'status'=>$this->smallInteger(3),

        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190917_035630_promocodes cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190917_035630_promocodes cannot be reverted.\n";

        return false;
    }
    */
}
