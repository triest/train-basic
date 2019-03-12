<?php

use yii\db\Migration;

/**
 * Class m190311_133747_add_name_to_shedule
 */
class m190311_133747_add_name_to_shedule extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('schedule', 'name', $this->string(64));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('schedule', 'name');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190311_133747_add_name_to_shedule cannot be reverted.\n";

        return false;
    }
    */
}
