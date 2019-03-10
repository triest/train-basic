<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TrainSchedule */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="train-schedule-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'departute_station_id')->textInput() ?>

    <?= $form->field($model, 'arrival_station_id')->textInput() ?>

    <?= $form->field($model, 'departut_time')->textInput() ?>

    <?= $form->field($model, 'arrival_time')->textInput() ?>

    <?= $form->field($model, 'travel_time')->textInput() ?>

    <?= $form->field($model, 'ticket_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'transport_company_id')->textInput() ?>

    <?= $form->field($model, 'schedule_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
