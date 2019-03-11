new Vue({
    el: '#stationApp',
    data: {
        stations: [],
        arrivaltime: '',
        delete_id: '',
        name: ''
    },
    methods: {

        get: function () {
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
            axios.get('/station/delete', {
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
                );
            this.get();
            $("#del-modal").modal('hide');
        },
        save: function () {
            console.log(this.name)
            var data = new FormData();
            data.append('name', this.name);
            window.axios.defaults.headers.common = {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }

            axios.post('/station/create',
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
            $("#create-modal").modal('hide');
        },
        createWindow: function () {
            $("#create-modal").modal('show');
        },
        editWindow: function (item) {
            this.name = item.name;
            this.id = item.id;
            $("#edit-modal").modal('show');
        },

        edit: function () {
            var data = new FormData();
            data.append('id', this.id);
            data.append('name', this.name);

            window.axios.defaults.headers.common = {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }

            axios.post('/station/update',
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
            $("#edit-modal").modal('hide');
        }
    }


    ,
    beforeMount() {
        this.get()
    }
    ,

})
;
