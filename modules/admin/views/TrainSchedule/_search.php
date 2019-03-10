<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TrainScheduleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="train-schedule-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'departute_station_id') ?>

    <?= $form->field($model, 'arrival_station_id') ?>

    <?= $form->field($model, 'departut_time') ?>

    <?php // echo $form->field($model, 'arrival_time') ?>

    <?php // echo $form->field($model, 'travel_time') ?>

    <?php // echo $form->field($model, 'ticket_price') ?>

    <?php // echo $form->field($model, 'transport_company_id') ?>

    <?php // echo $form->field($model, 'schedule_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
