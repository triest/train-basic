<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "schedule".
 *
 * @property int $id
 * @property string $days
 *
 * @property TrainSchedule[] $trainSchedules
 */
class Schedule extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'schedule';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['days'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'days' => 'Days',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrainSchedules()
    {
        return $this->hasMany(TrainSchedule::className(), ['schedule_id' => 'id']);
    }
}
