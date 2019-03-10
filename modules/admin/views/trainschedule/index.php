<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TrainscheduleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Train Schedules';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="train-schedule-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Train Schedule', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'departute_station_id',
            'arrival_station_id',
            'departut_time',
            //'arrival_time',
            //'travel_time',
            //'ticket_price',
            //'transport_company_id',
            //'schedule_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
