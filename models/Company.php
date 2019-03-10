<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "companies".
 *
 * @property int $id
 * @property string $name
 *
 * @property TrainSchedule[] $trainSchedules
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'companies';
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
        return $this->hasMany(TrainSchedule::className(), ['transport_company_id' => 'id']);
    }
}
