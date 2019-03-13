new Vue({
    el: '#companyApp',
    data: {
        company: [],
        arrivaltime: '',
        delete_id: '',
        name: ''
    },
    methods: {

        get: function () {
            axios.get('/company', {})
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
            axios.delete('/companies/' + this.delete_id
            )
                .then(
                    response => {
                        this.departute_station = response.data;
                    }
                )
                .catch(
                    error => console.log(error)
                )
            this.get();
            $("#del-modal").modal('hide');
            this.get();
        },
        save: function () {
            console.log(this.name)
            var data = new FormData();
            data.append('name', this.name);
            window.axios.defaults.headers.common = {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }

            axios.post('/company/create',
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
            };

            axios.post('/company/update',
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
