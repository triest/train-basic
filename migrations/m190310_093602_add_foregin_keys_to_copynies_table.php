<?php

use yii\db\Migration;

/**
 * Class m190310_093602_add_foregin_keys_to_copynies_table
 */
class m190310_093602_add_foregin_keys_to_copynies_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // creates index for column `user_id`
        $this->createIndex(
            'idx_departute_companies_id',
            'train_schedule',
            'transport_company_id'
        );
        // add foreign key for table `user`
        $this->addForeignKey(
            'timetable_departure_companies_id',
            'train_schedule',
            'transport_company_id',
            'companies',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190310_093602_add_foregin_keys_to_copynies_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190310_093602_add_foregin_keys_to_copynies_table cannot be reverted.\n";

        return false;
    }
    */
}
