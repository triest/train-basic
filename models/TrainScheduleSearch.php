<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TrainSchedule;

/**
 * TrainScheduleSearch represents the model behind the search form of `app\models\TrainSchedule`.
 */
class TrainScheduleSearch extends TrainSchedule
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'departute_station_id', 'arrival_station_id', 'transport_company_id', 'schedule_id'], 'integer'],
            [['name', 'departut_time', 'arrival_time', 'travel_time'], 'safe'],
            [['ticket_price'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = TrainSchedule::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'departute_station_id' => $this->departute_station_id,
            'arrival_station_id' => $this->arrival_station_id,
            'departut_time' => $this->departut_time,
            'arrival_time' => $this->arrival_time,
            'travel_time' => $this->travel_time,
            'ticket_price' => $this->ticket_price,
            'transport_company_id' => $this->transport_company_id,
            'schedule_id' => $this->schedule_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
