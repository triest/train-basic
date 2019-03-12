<?php

use yii\db\Migration;

/**
 * Class m190312_181545_schedule_days_table
 */
class m190312_181545_schedule_days_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('schedule_days', [
            'id' => $this->primaryKey(),
            'day_id' => $this->integer(),
            'shedule_id' => $this->integer()
        ]);


        // creates index for column `user_id`
        $this->createIndex(
            'idx_day_id',
            'schedule_days',
            'day_id'
        );
        // add foreign key for table `user`
        $this->addForeignKey(
            'day_shedule_day_id',
            'schedule_days',
            'day_id',
            'days',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('schedule_days');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190312_181545_schedule_days_table cannot be reverted.\n";

        return false;
    }
    */
}
