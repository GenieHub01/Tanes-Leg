<?php

use yii\db\Migration;

/**
 * Class m191007_085213_code
 */
class m191007_085213_code extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('codes',[

            'title'=>$this->string(15),
            'type'=>$this->smallInteger(2),
            'value'=>$this->decimal(8,2)
        ]);

        $this->addPrimaryKey('codes_pk','codes',['title','type']);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191007_085213_code cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191007_085213_code cannot be reverted.\n";

        return false;
    }
    */
}
