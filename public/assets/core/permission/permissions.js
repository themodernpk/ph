Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');
//----------------------------------


//----------------------------------
var url_list = $("#url_list").val();
//----------------------------------


var app = new Vue({
    el: '#vueApp',
    data: {
        url_list: url_list,
        message: url_list
    },
    created: function ()
    {
        console.log("checking");
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