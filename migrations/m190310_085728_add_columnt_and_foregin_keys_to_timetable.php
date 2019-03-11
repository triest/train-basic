<?php

use yii\db\Migration;

/**
 * Class m190310_085728_add_columnt_and_foregin_keys_to_timetable
 */
class m190310_085728_add_columnt_and_foregin_keys_to_timetable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('train_schedule', 'departute_station_id', $this->integer());
        $this->addColumn('train_schedule', 'arrival_station_id', $this->integer());
        $this->addColumn('train_schedule', 'departut_time', $this->dateTime());
        $this->addColumn('train_schedule', 'arrival_time', $this->dateTime());
        $this->addColumn('train_schedule', 'travel_time', $this->time());
        $this->addColumn('train_schedule', 'ticket_price', $this->decimal());
        $this->addColumn('train_schedule', 'transport_company_id', $this->integer());
        $this->addColumn('train_schedule', 'schedule_id', $this->integer());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190310_085728_add_columnt_and_foregin_keys_to_timetable cannot be reverted.\n";

        return false;
    }
    */
}
