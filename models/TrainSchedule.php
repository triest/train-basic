<?php

namespace app\models;

use DeepCopy\TypeFilter\ShallowCopyFilter;
use Yii;

/**
 * This is the model class for table "train_schedule".
 *
 * @property int $id
 * @property string $name
 * @property int $departute_station_id
 * @property int $arrival_station_id
 * @property string $departut_time
 * @property string $arrival_time
 * @property string $travel_time
 * @property string $ticket_price
 * @property int $transport_company_id
 * @property int $schedule_id
 *
 * @property Station $arrivalStation
 * @property Company $transportCompany
 * @property Schedule $schedule
 * @property Station $departuteStation
 */
class TrainSchedule extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'train_schedule';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['departute_station_id', 'arrival_station_id', 'transport_company_id', 'schedule_id'], 'integer'],
            [['departut_time', 'arrival_time', 'travel_time'], 'safe'],
            [['ticket_price'], 'number'],
            [['name'], 'string', 'max' => 255],
            [
                ['arrival_station_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Station::className(),
                'targetAttribute' => ['arrival_station_id' => 'id'],
            ],
            [
                ['transport_company_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Company::className(),
                'targetAttribute' => ['transport_company_id' => 'id'],
            ],
            [
                ['schedule_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Schedule::className(),
                'targetAttribute' => ['schedule_id' => 'id'],
            ],
            [
                ['departute_station_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Station::className(),
                'targetAttribute' => ['departute_station_id' => 'id'],
            ],
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
            'departute_station_id' => 'Departute Station ID',
            'arrival_station_id' => 'Arrival Station ID',
            'departut_time' => 'Departut Time',
            'arrival_time' => 'Arrival Time',
            'travel_time' => 'Travel Time',
            'ticket_price' => 'Ticket Price',
            'transport_company_id' => 'Transport Company ID',
            'schedule_id' => 'Schedule ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArrivalstation()
    {
        return $this->hasOne(Station::className(), ['id' => 'arrival_station_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransportcompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'transport_company_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchedule()
    {
        return $this->hasOne(Schedule::className(), ['id' => 'schedule_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartutestation()
    {
        return $this->hasOne(Station::className(), ['id' => 'departute_station_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrainschedule()
    {
        return $this->hasOne(Schedule::className(), ['id' => 'schedule_id']);
    }

    public function saveDepartion($station)
    {
        $this->link('departutestation', $station);
    }

    public function saveArrived($station)
    {
        $this->link('arrivalstation', $station);
    }

    public function saveCompany($company)
    {
        $this->link('transportcompany', $company);
    }

    public function saveShedule($shedule)
    {
        $this->link('trainschedule',$shedule);
    }


}
