<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "schedule".
 *
 * @property int $id
 * @property string $days
 * @property string $name
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
            [['name'], 'string', 'max' => 64],
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
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrainSchedules()
    {
        return $this->hasMany(TrainSchedule::className(), ['schedule_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDays(){
        $days = $this->hasMany(Day::className(), ['id' => 'day_id'])
            ->select(['id', 'name'])
            ->viaTable('schedule_days', ['shedule_id' => 'id']);
        return $days;
    }

    public function saveDay($day)
    {
        $this->link('days', $day); //соединяем
    }
}
