new Vue({
    el: '#stationApp',
    data: {
        stations: [],
        arrivaltime: '',
        delete_id: '',
        name: ''
    },
    methods: {

        getStations: function () {
            axios.get('/api/getstations', {})
                .then(response => {
                    //  console.log(response.data)
                    this.stations = response.data;
                })
                .catch(error => {

                });
        },
        deleteWindow: function (id) {
            console.log(id);
            this.delete_id = id;
            $("#del-modal").modal('show');
        },
        confurmDelete: function () {
            axios.get('/api/delstation', {
                    params:
                        {
                            id: this.delete_id
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
            this.getStations();
        },
        save: function () {
            console.log(this.name)
            var data = new FormData();
            data.append('name', this.name);
            window.axios.defaults.headers.common = {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }

            axios.post('/api/createstation',
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
            this.getStations();
        },
        createWindow: function () {
            $("#create-modal").modal('show');
        }
    }


    ,
    beforeMount() {
        this.getStations()
    }
    ,

})
;
