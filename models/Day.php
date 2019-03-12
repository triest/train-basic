<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "days".
 *
 * @property int $id
 * @property string $name
 *
 * @property ScheduleDays[] $scheduleDays
 */
class Day extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'days';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScheduleDays()
    {
        return $this->hasMany(ScheduleDays::className(), ['day_id' => 'id']);
    }


    public function getSchedule()
    {
        $days = $this->hasMany(Schedule::className(), ['id' => 'shedule_id'])
            ->select(['id', 'name'])
            ->viaTable('schedule_days', ['day_id' => 'id']);
        return $days;
    }
}
