<?php

use yii\db\Migration;

/**
 * Class m190312_181010__create_days_table
 */
class m190312_181010__create_days_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('days', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
        ]);


        $this->insert('days', [
            'name' => 'Monday',
        ]);
        $this->insert('days', [
            'name' => 'Tuesday',
        ]);
        $this->insert('days', [
            'name' => 'Wednesday',
        ]);
        $this->insert('days', [
            'name' => 'Thursday',
        ]);
        $this->insert('days', [
            'name' => 'Friday',
        ]);
        $this->insert('days', [
            'name' => ' Saturday',
        ]);
        $this->insert('days', [
            'name' => 'Sunday',
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('days');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190312_181010__create_days_table cannot be reverted.\n";

        return false;
    }
    */
}
