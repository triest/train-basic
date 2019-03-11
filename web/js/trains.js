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
        selected_transporters: ''
    },
    methods: {
        getSchedule: function () {
            this.trainSchedules = null;
            axios.get('/api')
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
            console.log(id),
                this.delete_id = id;
            $("#del-modal").modal('show');
        },
        confurmDelete: function () {
            console.log(this.delete_id)
            var data = new FormData();
            data.append('del', this.id);
            axios.get('/api/delstation', {
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
            this.getSchedule();
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
        getStations: function () {

        },
        save: function () {
            console.log(this.name);
            console.log(this.selected_departute_station);
            console.log(this.selected_arrival_station);
            console.log(this.selected_transporters);
            console.log(this.input_price);
            $("#create-modal").modal('hide');
            // тправляе post запрос
            var data = new FormData();
            data.append('id', this.name);
            data.append('name', this.name);
            data.append('departute_station', this.selected_departute_station);
            data.append('arrival_station', this.selected_arrival_station);
            data.append('transportCompyny', this.selected_transporters);
            data.append('price', this.input_price);

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

                })

        }

    },
    computed: {},
    beforeMount() {
        this.getSchedule()
    },

});
