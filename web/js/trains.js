new Vue({
    el: '#trainApp',
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
        selected_price: '',
        selected_transporter: '',
        current_item: '',
        shedule_id: ''
    },
    methods: {
        get: function () {
            this.trainSchedules = null;
            axios.get('/trainschedule')
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

        deleteWindow: function (id) {
            console.log(id),
                this.delete_id = id;
            $("#del-modal").modal('show');
        },
        confurmDelete: function () {
            console.log(this.delete_id)
            var data = new FormData();
            data.append('del', this.id);
            axios.get('/api/delete', {
                    params:
                        {
                            id: this.delete_id
                        }
                }
            )
                .then(res => {

                })
                .catch(error => {

                });
            $("#del-modal").modal('hide');
            this.get();
        },
        createWindow: function () {
            //получаем станции:
            axios.get('/trainschedule/getstations', {})
                .then(response => {
                    //  console.log(response.data)
                    this.departute_station = response.data;
                })
                .catch(error => {

                });
            axios.get('/trainschedule/gettransporters', {})
                .then(response => {
                    //  console.log(response.data)
                    this.transporters = response.data;
                })
                .catch(error => {

                });

            $("#create-modal").modal('show');
        },

        save: function () {

            $("#create-modal").modal('hide');
            // тправляе post запрос
            var data = new FormData();
            data.append('id', this.name);
            data.append('name', this.name);
            data.append('departute_station', this.selected_departute_station);
            data.append('arrival_station', this.selected_arrival_station);
            data.append('transportCompyny', this.selected_transporters);
            data.append('price', this.input_price);
            data.append('despatchtime', this.despatchtime);
            data.append('arrivaltime', this.arrivaltime)

            window.axios.defaults.headers.common = {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }

            axios.post('/api/create',
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
            data.append('id', this.delete_id);
            data.append('name', this.name);
            data.append('departute_station_id', this.selected_departute_station);
            data.append('arrival_station_id', this.selected_arrival_station);
            data.append('departut_time', this.despatchtime);
            data.append('arrival_time', this.arrivaltime);
            data.append('travel_time','1');
            data.append('ticket_price', this.input_price);
            data.append('transport_company_id', this.selected_transporters);
            data.append('schedule_id',this.shedule_id);


            window.axios.defaults.headers.common = {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }

            axios.post('/api/update',
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

                })
            this.get();


        },
        editWindow: function (item) {
            this.delete_id = item.id;
            this.name = item.name;
            this.input_price = item.ticket_price;
            this.despatchtime = item.departut_time;
            this.arrivaltime = item.arrival_time;
            this.selected_departute_station = item.departion_id;
            this.selected_arrival_station = item.arraval_id;
            this.selected_transporters = item.company_id;
            this.shedule_id = item.schedule_id;

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


            $("#edit-modal").modal('show');
        }

    },
    computed: {},
    beforeMount() {
        this.get()
    },

});
