Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');
//----------------------------------


//----------------------------------
var url_list = $("#url_list").val();
//----------------------------------


var app = new Vue({
    el: '#vueApp',
    data: {
        url_list: url_list,
        message: null
    },
    ready: function ()
    {
        console.log("testing");
    },
    methods: {

        fetchList: function () {
            console.log(this.url_list);



        }
        //-----------------------------------------------------------------
        //-----------------------------------------------------------------
        //-----------------------------------------------------------------
        //-----------------------------------------------------------------

    }



});