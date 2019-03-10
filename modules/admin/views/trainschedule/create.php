<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TrainSchedule */

$this->title = 'Create Train Schedule2';
$this->params['breadcrumbs'][] = ['label' => 'Train Schedules', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="train-schedule-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'arrivalStation'=>$arrivalStation,
        'departureStation'=>$departuteStation,
        'transportCompyny'=>$transportCompyny,
        'Schedule'=>$Schedule
    ]) ?>

</div>
