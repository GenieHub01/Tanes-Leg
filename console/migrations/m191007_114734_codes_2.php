<?php

use yii\db\Migration;

/**
 * Class m191007_114734_codes_2
 */
class m191007_114734_codes_2 extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->dropTable('codes');
        $this->createTable('codes',[

            'id'=>$this->primaryKey(),
            'title'=>$this->string(15),
            'type'=>$this->smallInteger(2),
            'value'=>$this->decimal(8,2)
        ]);

        $this->createIndex('codes_pk','codes',['title','type']);


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191007_114734_codes_2 cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191007_114734_codes_2 cannot be reverted.\n";

        return false;
    }
    */
}
