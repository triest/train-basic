new Vue({
    el: '#trainApp',
    data: {
        trainSchedules: [],
        delete_id: ''

    },
    methods: {
        getSchedule: function () {
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
                        temp = response.data;
                        return temp.name
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
        }

    },
    computed: {},
    beforeMount() {
        this.getSchedule()
    },

});
