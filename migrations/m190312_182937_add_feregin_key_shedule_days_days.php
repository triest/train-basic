<?php

use yii\db\Migration;

/**
 * Class m190312_182937_add_feregin_key_shedule_days_days
 */
class m190312_182937_add_feregin_key_shedule_days_days extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createIndex(
            'idx_shedule_id',
            'schedule_days',
            'shedule_id'
        );
        // add foreign key for table `user`
        $this->addForeignKey(
            'day_shedule_shedule_id',
            'schedule_days',
            'shedule_id',
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
        echo "m190312_182937_add_feregin_key_shedule_days_days cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190312_182937_add_feregin_key_shedule_days_days cannot be reverted.\n";

        return false;
    }
    */
}
