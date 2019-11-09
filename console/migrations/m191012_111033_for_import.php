<?php

use yii\db\Migration;

/**
 * Class m191012_111033_for_import
 */
class m191012_111033_for_import extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()


    {
        $this->addColumn('goods', 'pa_part_number_last_item', $this->string());
        $this->addColumn('goods', 'pa_engine_type_name', $this->string());
        $this->addColumn('goods', 'product_cat_name', $this->string());
        $this->addColumn('goods', 'pa_engine_power_name', $this->string());
        $this->addColumn('goods', 'pa_extra_work', $this->string());
        $this->addColumn('goods', 'p_year_list', $this->string());
        $this->addColumn('goods', 'import', $this->integer()->defaultValue(0));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191012_111033_for_import cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191012_111033_for_import cannot be reverted.\n";

        return false;
    }
    */
}
