<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stations".
 *
 * @property int $id
 * @property string $name
 *
 * @property TrainSchedule[] $trainSchedules
 * @property TrainSchedule[] $trainSchedules0
 */
class Station extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stations';
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
    public function getTrainSchedules()
    {
        return $this->hasMany(TrainSchedule::className(), ['arrival_station_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrainSchedules0()
    {
        return $this->hasMany(TrainSchedule::className(), ['departute_station_id' => 'id']);
    }
}
