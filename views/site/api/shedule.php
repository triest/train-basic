<?php

/* @var $this yii\web\View */
$this->registerJsFile('@web/js/shedule.js');
$this->title = 'Stations';

?>
<div class="site-index">


    <div class="body-content">
        <div id="sheduleApp" class="vue">

            <!--модальное окно для удаления-->
            <div id="del-modal" class="modal fade">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">

                        </div>
                        <div class="modal-body">
                            <b>Удалить расписаниеЫ?</b>
                        </div>
                        <button type="button" class="btn btn-secondary" v-on:click="confurmDelete">Yes</button>
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
                            <label>Название</label>
                            <input type="text" v-model="name" name="text">
                            <br>
                            <input type="checkbox" id="Mondey" value="Mondey" v-model="checkedDays">
                            <label for="Mondey">Mondey</label>
                            <br>
                            <input type="checkbox" id="Tuesday" value="Tuesday" v-model="checkedDays">
                            <label for="Tuesday">Tuesday</label>
                            <br>
                            <input type="checkbox" id="Wednesday" value="wednesday" v-model="checkedDays">
                            <label for="Wednesday">Wednesday</label>
                            <br>
                            <input type="checkbox" id="Thursday" value="thursday" v-model="checkedDays">
                            <label for="Thursday">Thursday</label>
                            <br>
                            <input type="checkbox" id="Friday" value="friday" v-model="checkedDays">
                            <label for="Friday">Friday</label>
                            <br>
                            <input type="checkbox" id="Saturday" value="saturday" v-model="checkedDays">
                            <label for="Saturday">Saturday</label>
                            <br>
                            <input type="checkbox" id="Saturday" value="sanday" v-model="checkedDays">
                            <label for="Sanday">Sanday</label>
                            <br>
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

                    </thead>
                    <tbody>
                    <tr v-for="item in trainSchedules">
                        <td>
                            {{item.id}}
                        </td>
                        <td>
                            {{item.days}}
                        </td>
                        <td>
                            <button class="btn btn-danger" v-on:click="editWindow(item)">Редактирвать</button>
                        </td>
                        <td>
                            <button class="btn btn-danger" v-on:click="deleteWindow(item.id)">Удалить</button>
                        </td>


                    </tr>
                    </tbody>
                </table>

            </div>

        </div>
    </div>
