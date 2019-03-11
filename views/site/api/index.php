<?php

/* @var $this yii\web\View */
$this->registerJsFile('@web/js/trains.js');
$this->title = 'Trains';

?>
<div class="site-index">


    <div class="body-content">
        <div id="trainApp" class="vue">

            <!--модальное окно для удаления-->
            <div id="del-modal" class="modal fade">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">

                        </div>
                        <div class="modal-body">
                            <b>Удалить из расписания?</b>
                            <button type="button" class="btn btn-secondary" v-on:click="confurmDelete">Yes</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        </div>


                    </div>
                </div>
            </div>
            <!--конец -->
            <div id="create-modal" class="modal fade">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">

                        </div>
                        <div class="modal-body">

                            <br>
                            <label>Название</label>
                            <input type="text" v-model="name" name="text">
                            <br>
                            Стация отправдения:
                            <select v-model="selected_departute_station">
                                <option v-for="station in departute_station" v-bind:value="station.id">
                                    {{station.name}}
                                </option>
                            </select>
                            <br>
                            Стация назначения:
                            <select v-model="selected_arrival_station">
                                <option v-for="station in departute_station" v-bind:value="station.id">
                                    {{station.name}}
                                </option>
                            </select>
                            <br>
                            Перевозщик:
                            <select v-model="selected_transporters">
                                <option v-for="transporter in transporters"  v-bind:value="transporter.id">
                                    {{transporter.name}}
                                </option>
                            </select>
                            <br>
                            <label>Цена билета:</label>
                            <input type="text" v-model="input_price" name="text">
                            <br>
                            <label>Время отправления</label>
                            <input type="time" v-model="despatchtime">
                            <label>Время прибытия</label>
                            <input type="time" v-model="arrivaltime">
                            <button type="button" class="btn btn-secondary" v-on:click="save">Создать</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Отменить</button>
                        </div>


                    </div>
                </div>
            </div>

            <div id="edit-modal" class="modal fade">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">

                        </div>
                        <div class="modal-body">


                            <br>
                            <label>Название</label>
                            <input type="text" v-model="name" name="text">
                            <br>
                            Стация отправдения:
                            <select v-model="selected_departute_station">
                                <option v-for="station in departute_station" v-bind:value="station.id">
                                    {{station.name}}
                                </option>
                            </select>
                            <br>
                            Стация назначения:
                            <select v-model="selected_arrival_station">
                                <option v-for="station in departute_station" v-bind:value="station.id">
                                    {{station.name}}
                                </option>
                            </select>
                            <br>
                            Перевозщик:
                            <select v-model="selected_transporters">
                                <option v-for="transporter in transporters"  v-bind:value="transporter.id">
                                    {{transporter.name}}
                                </option>
                            </select>
                            <br>
                            <label>Цена билета:</label>
                            <input type="text" v-model="input_price" name="text">
                            <br>
                            <label>Время отправления</label>
                            <input type="time" v-model="despatchtime">
                            <label>Время прибытия</label>
                            <input type="time" v-model="arrivaltime">
                            <button type="button" class="btn btn-secondary" v-on:click="save">Создать</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Отменить</button>
                        </div>


                    </div>
                </div>
            </div>

            <button class="btn-primary" v-on:click="createWindow()">Созать расписание</button>

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

                        <td>
                            <button class="btn btn-danger" v-on:click="deleteWindow(trainsScedule.id)">Удалить</button>
                        </td>

                        <td>
                            <button class="btn btn-primary" v-on:click="editWindow(trainsScedule)">РедактироватьЫ
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>

            </div>

        </div>
    </div>
