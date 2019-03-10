<?php

use yii\db\Migration;

/**
 * Class m190310_095132_add_foregin_keys_to_schedule_table
 */
class m190310_095132_add_foregin_keys_to_schedule_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createIndex(
            'idx_departute_schedule_id',
            'train_schedule',
            'schedule_id'
        );
        // add foreign key for table `user`
        $this->addForeignKey(
            'timetable_departure_shedule_id',
            'train_schedule',
            'schedule_id',
            'schedule',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190310_095132_add_foregin_keys_to_schedule_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190310_095132_add_foregin_keys_to_schedule_table cannot be reverted.\n";

        return false;
    }
    */
}
