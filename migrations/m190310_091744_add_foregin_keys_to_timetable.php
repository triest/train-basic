<?php

use yii\db\Migration;

/**
 * Class m190310_091744_add_foregin_keys_to_timetable
 */
class m190310_091744_add_foregin_keys_to_timetable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        //stations

        // creates index for column `user_id`
        $this->createIndex(
            'idx_departute_station_id',
            'train_schedule',
            'departute_station_id'
        );
        // add foreign key for table `user`
        $this->addForeignKey(
            'timetable_departure_station_station_id',
            'train_schedule',
            'departute_station_id',
            'stations',
            'id',
            'CASCADE'
        );
        // creates index for column `user_id`
        $this->createIndex(
            'idx_arrival_station_id',
            'train_schedule',
            'arrival_station_id'
        );
        // add foreign key for table `user`
        $this->addForeignKey(
            'timetable_arrival_station_station_id',
            'train_schedule',
            'arrival_station_id',
            'stations',
            'id',
            'CASCADE'
        );


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190310_091744_add_foregin_keys_to_timetable cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190310_091744_add_foregin_keys_to_timetable cannot be reverted.\n";

        return false;
    }
    */
}
