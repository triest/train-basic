new Vue({
    el: '#stationApp',
    data: {
        company: [],
        arrivaltime: '',
        delete_id: '',
        name: ''
    },
    methods: {

        get: function () {
            axios.get('/api/getcompany', {})
                .then(response => {
                    //  console.log(response.data)
                    this.company = response.data;
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
            axios.get('/api/delcompany', {
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

            axios.post('/api/createcompany',
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
        createWindow: function () {
            $("#create-modal").modal('show');
        }
    }


    ,
    beforeMount() {
        this.get()
    }
    ,

})
;
