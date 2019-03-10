new Vue({
    el: '#trainApp',
    data: {
        trainSchedules: []

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
                        temp=response.data;
                        return temp.name
                    }
                )
                .catch(
                    error => console.log(error)
                )
        }

    },
    computed: {},
    beforeMount() {
        this.getSchedule()
    },

});
