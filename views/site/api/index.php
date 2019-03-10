<?php

/* @var $this yii\web\View */
$this->registerJsFile('@web/js/trains.js');
$this->title = 'Trains';

?>
<div class="site-index">


    <div class="body-content">
        <div id="trainApp" class="vue">

            <!--модальное окно -->
            <div id="del-modal" class="modal fade">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">

                        </div>
                        <div class="modal-body">
                            <b>Удалить из расписания?</b>
                            <button type="button" class="btn btn-secondary" v-on:click="confurmDelete" >Yes</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" >No</button>
                        </div>


                    </div>
                </div>
            </div>
            <!--конец -->
           <button>Создать расписание</button>

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
                           {{trainsScedule.departion_name}}
                        </td>
                        <td>
                            {{trainsScedule.departut_time }}
                        </td>
                        <td>
                            {{trainsScedule.arraval_name}}
                        </td>
                        <td>
                            {{trainsScedule.arrival_time}}
                        </td>
                        <td>
                            {{trainsScedule.ticket_price}}
                        </td>

                        <td> <button class="btn btn-danger"  v-on:click="deleteWindow(trainsScedule.id)">Удалить</button>
                        </td>
                    </tr>
                    </tbody>
                </table>

            </div>

        </div>
    </div>
