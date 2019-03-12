<?php

use yii\db\Migration;

/**
 * Class m190311_085145_change_time_data_type
 */
class m190311_085145_change_time_data_type extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('train_schedule', 'departut_time', 'time');
        $this->alterColumn('train_schedule', 'arrival_time', 'time');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('train_schedule', 'departut_time', 'datetime');
        $this->alterColumn('train_schedule', 'arrival_time', 'datetime');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190311_085145_change_time_data_type cannot be reverted.\n";

        return false;
    }
    */
}
