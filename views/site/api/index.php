<?php

/* @var $this yii\web\View */
$this->registerJsFile('@web/js/trains.js');
$this->title = 'Trains';

?>
<div class="site-index">


    <div class="body-content">
        <div id="trainApp" class="vue">


            <div class="row">
                <table class="table table-condensed">
                    <thead>
                    <th>
                        Name
                    </th>
                    <th>
                        Станция отправления
                    </th>
                    <th>
                        Время отправления
                    </th>
                    <th>
                        Станция назначения
                    </th>
                    <th>
                        Время прибытия
                    </th>
                    <th>
                        Цена билета
                    </th>
                    </thead>
                    <tbody>
                    <tr v-for="trainsScedule in trainSchedules">
                        <td>
                            {{trainsScedule.name}}
                        </td>

                        <td>
                           {{trainsScedule.arrival_station_id}}
                        </td>
                        <td>
                            {{trainsScedule.departut_time }}
                        </td>
                        <td>
                            {{trainsScedule.arrival_station_id}}
                        </td>
                        <td>
                            {{trainsScedule.arrival_time}}
                        </td>
                        <td>
                            {{trainsScedule.ticket_price}}
                        </td>
                    </tr>
                    </tbody>
                </table>

            </div>

        </div>
    </div>
