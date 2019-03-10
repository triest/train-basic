<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TrainSchedule */

$this->title = 'Update Train Schedule: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Train Schedules', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="train-schedule-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formUpdate', [
        'model' => $model,
        'arrivalStation'=>$arrivalStation,
        'departureStation'=>$departuteStation,
        'transportCompyny'=>$transportCompyny,
        'Schedule'=>$Schedule
    ]) ?>

</div>
