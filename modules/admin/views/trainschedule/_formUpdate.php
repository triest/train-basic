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

    <?= Html::dropDownList('arrival_station', [], $arrivalStation, ['class' => 'form-control', 'multiple' => true,['options' => ['selected'=>true]] ]) ?>

    <?= Html::dropDownList('departure_station', [], $departureStation, ['class' => 'form-control', 'multiple' => true,['options' => ['selected'=>true]] ]) ?>

    <?= Html::dropDownList('transportCompyny', [], $transportCompyny, ['class' => 'form-control', 'multiple' => true,['options' => ['selected'=>true]] ]) ?>

    <?= $form->field($model, 'departut_time')->textInput() ?>

    <?= $form->field($model, 'arrival_time')->textInput() ?>

    <?= $form->field($model, 'travel_time')->textInput() ?>

    <?= $form->field($model, 'ticket_price')->textInput(['type' => 'number','min'=>0]) ?>

    <?= Html::dropDownList('Schedule', [], $Schedule, ['class' => 'form-control', 'multiple' => true,['options' => ['selected'=>true]] ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
