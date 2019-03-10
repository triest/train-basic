<?php

use yii\db\Migration;

/**
 * Class m190310_083903_timetable
 */
class m190310_083903_timetable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('train_schedule', [
            'id' => $this->primaryKey(),
            'name' => $this->string()]);

    }

    /**
     * {@inheritdoc}
     */
    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('subscription');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190310_083903_timetable cannot be reverted.\n";

        return false;
    }
    */
}
