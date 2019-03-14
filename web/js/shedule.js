new Vue({
    el: '#sheduleApp',
    data: {
        trainSchedules: [],
        delete_id: '',
        name: '', //для модального окна создания
        departute_station: '', // станции
        selected_station: '',
        selected_departute_station: '',
        selected_arrival_station: '',
        input_price: '',
        transporters: '',
        selected_transporters: '',
        despatchtime: '',
        arrivaltime: '',
        checked: [],
        checkedDays: [],
        selectedDays: [],
        form: [],
        modules: [
            {
                "id": 1,
                "name": "Monday",
            },
            {
                "id": 2,
                "name": "Tuesday",
            },
            {
                "id": 3,
                "name": "Wednesday",
            },
            {
                "id": 4,
                "name": "Thursday",
            },
            {
                "id": 5,
                "name": "Friday",
            },
            {
                "id": 6,
                "name": "Saturday",
            },
            {
                "id": 7,
                "name": "Sunday",
            }

        ]
    },
    methods: {
        get: function () {
            this.trainSchedules = null;
            axios.get('/schedule', {})
                .then(
                    response => {
                        //this.users = response.data;
                        this.trainSchedules = response.data
                    }
                )
                .catch(
                    error => console.log(error)
                )
        },
        getStation: function (id) {
            axios.get('/api/getstation', {
                    params:
                        {
                            id: id
                        }
                }
            )
                .then(
                    response => {
                        //this.users = response.data;
                        //this.trainSchedules = response.data
                        this.departute_station = response.data;
                    }
                )
                .catch(
                    error => console.log(error)
                )
        },
        deleteWindow: function (id) {
            this.delete_id = id;
            $("#del-modal").modal('show');
        },
        confurmDelete: function () {
            var data = new FormData();
            data.append('del', this.id);
            axios.delete('/schedules/' + this.delete_id)
                .then(res => {

                })
                .catch(error => {

                });
            $("#del-modal").modal('hide');
            this.get();
        },
        createWindow: function () {
            //получаем станции:
            axios.get('/api/getstations', {})
                .then(response => {
                    //  console.log(response.data)
                    this.departute_station = response.data;
                })
                .catch(error => {

                });
            axios.get('/api/gettransporters', {})
                .then(response => {
                    //  console.log(response.data)
                    this.transporters = response.data;
                })
                .catch(error => {

                });

            $("#create-modal").modal('show');
        },
        editWindow: function (item) {
            this.name = item.name;
            this.id = item.id;


            axios.get('/schedule/getdays', {
                    params:
                        {
                            id: this.id
                        }
                }
            )
                .then(res => {
                    this.form = res.data
                })
                .catch(error => {

                });

            $("#edit-modal").modal('show');
        },
        save: function () {

            $("#create-modal").modal('hide');
            // тправляе post запрос
            var data = new FormData();

            data.append('days', this.checkedDays);
            data.append('name', this.name)
            window.axios.defaults.headers.common = {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }

            axios.post('/schedule/create',
                data,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
            )
                .then(res => {

                })
                .catch(error => {

                });
            this.get();
        },
        edit: function () {
            var data = new FormData();
            data.append('id', this.id);
            data.append('name', this.name);
            data.append('days', this.form);
            window.axios.defaults.headers.common = {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            };
            axios.put('/schedules' + this.id + '?name=' + this.name
                /*   data,
                   {
                       headers: {
                           'Content-Type': 'multipart/form-data'
                       }
                   }*/
            )
                .then(res => {

                })
                .catch(error => {

                })
            this.get();
        }

    },
    computed: {},
    beforeMount() {
        this.get()

    },

});
