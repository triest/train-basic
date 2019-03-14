<?php

/* @var $this yii\web\View */
$this->registerJsFile('@web/js/station.js');
$this->title = 'Stations';

?>
<div class="site-index">


    <div class="body-content">
        <div id="stationApp" class="vue">

            <!--модальное окно для удаления-->
            <div id="del-modal" class="modal fade">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">

                        </div>
                        <div class="modal-body">
                            <b>Удалить станцию?</b>
                        </div>
                        <button type="button" class="btn btn-danger" v-on:click="confurmDelete">Yes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>

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

                            <button type="button" class="btn btn-primary" v-on:click="save">Создать</button>
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

                            <button type="button" class="btn btn-primary" v-on:click="edit">Создать</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Отменить</button>
                        </div>


                    </div>
                </div>
            </div>

            <button class="btn-primary" v-on:click="createWindow()">Созать станцию</button>

            <div class="row">
                <table class="table table-condensed">
                    <thead>
                    <th>
                        Name
                    </th>

                    </thead>
                    <tbody>
                    <tr v-for="station in stations">
                        <td>
                            {{station.name}}
                        </td>
                        <td>
                            {{station.id}}
                        </td>
                        <td>
                            <button class="btn btn-primary" v-on:click="editWindow(station)">Редактировать
                            </button>
                        </td>
                        <td>
                            <button class="btn btn-danger" v-on:click="deleteWindow(station.id)">Удалить</button>
                        </td>
                    </tr>
                    </tbody>
                </table>

            </div>

        </div>
    </div>
