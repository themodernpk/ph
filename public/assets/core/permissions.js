Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');

var app = new Vue({
    el: '#app',
    data: {
        url_list: null
    },
    ready: function () {

        this.fetchList();
        console.log(this.url_list);

    },
    methods: {

        fetchList: function () {


            this.$http.get(this.url_list).then((response) => {
                console.log(response);

            }, (response) => {
                // error callback
            });

        }
        //-----------------------------------------------------------------
        //-----------------------------------------------------------------
        //-----------------------------------------------------------------
        //-----------------------------------------------------------------

    }



});