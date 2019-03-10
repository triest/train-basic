<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%stations}}`.
 */
class m190310_085205_create_stations_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%stations}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%stations}}');
    }
}
