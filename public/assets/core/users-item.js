(function (document, window, $) {
    'use strict';
    var UsersModule = {
        data: {},
        //----------------------------------------
        init: function () {
            var current_url = $("input[name=url_current]").val();
            this.data.url = {
                current: current_url,
                list: current_url+"/list/?",
            };
        },
        //----------------------------------------
        handlePagination: function (data) {

            var total = parseFloat(data.total);
            $("#paginate").paging(total, {
                format: '[< nncnn >]',
                perpage: data.per_page,
                lapping: 0,
                page: data.current_page,
                onSelect: function (page) {
                    if (page != data.current_page) {
                        UsersModule.buildListUrl(page);
                    }
                },
                onFormat: function (type) {
                    switch (type) {
                        case 'block': // n and c
                            if (this.value == data.current_page) {
                                var html = '<li class="active page-item"><a class="page-link" href="#">' + this.value + '</a></li>';
                            } else {
                                var html = '<li class="page-item"><a class="page-link" href="#">' + this.value + '</a></li>';
                            }
                            return html;
                        case 'next':
                            return '<li class="page-item"><a class="page-link" href="#"><span class="icon fa-angle-right"></span></a></li>';
                        case 'prev':
                            return '<li class="page-item"><a class="page-link" href="#"><span class="icon fa-angle-left"></span></a></li>';
                        case 'first':
                            return '<li class="page-item"><a class="page-link" href="#"><span class="icon fa-angle-double-left"></span></a></li>';
                        case 'last':
                            return '<li class="page-item"><a class="page-link "  href="#"><span class="icon fa-angle-double-right"></span></a></li>';
                    }
                }
            });
        },

        //----------------------------------------
        handleAjax: function (url, callbackfn, data, method) {
            if (!method) {
                method = "GET";
            }
            var ajaxOpt = {
                method: method,
                url: url,
                async: true,
                context: this,
            };
            if (data) {
                ajaxOpt.data = data;
            }
            $.ajax(ajaxOpt).done(function (response) {
                console.log("ajax response", response);
                NProgress.done();
                if (response.status == "success" && callbackfn) {
                    callbackfn(response);
                } else {
                    $.each(response.errors, function (index, object) {
                        alertify.error(object);
                    });
                }
            });
        },
        //----------------------------------------
        buildListUrl: function (page) {
            var url = UsersModule.data.url.list;
            if (page === undefined) {
                url += "page=1";
            } else {
                url += "page=" + page;
            }
            var s = $(".search").val();
            if (s && s != "") {
                url += "&s=" + s;
            }
            var trashed = $("input[name=trashed]").val();
            if (trashed == 1) {
                url += "&trashed=" + trashed;
            }
            UsersModule.fetchList(url);
        },
        //----------------------------------------
        fetchList: function (url) {
            console.log(url);
            NProgress.start();
            $.ajax({
                url: url,
            }).done(function (response) {
                NProgress.done();
                console.log(response);
                //console.log(response.html);
                $("#list").html(response.html);
                $("#trashCount").html(response.trashCount);
                UsersModule.handlePagination(response.list);
                /*if (s != "") {
                    $("#list").highlight(s);
                }*/
            });
        },

        //----------------------------------------
        deleteUser: function () {

            $("body").on("click", ".itemDelete", function (e) {
                e.preventDefault();
                var url = $(this).attr("href");
                UsersModule.handleAjax(url,UsersModule.buildListUrl);
            });

        },
        //----------------------------------------
        enableToggle: function () {

            $("body").on("click", ".enableToggle", function (e) {
                e.preventDefault();
                var url = $(this).attr("href");
                UsersModule.handleAjax(url,UsersModule.buildListUrl);
            });

        },
        //----------------------------------------
        run: function () {
            var self = this;
            this.init();
            this.buildListUrl();
            this.deleteUser();
            this.enableToggle();
        }
        //----------------------------------------
    };
    //-------------------------------------------
    $(document).ready(function () {
        UsersModule.run();
    });
    //-------------------------------------------
    //########### Form Validation
    (function () {
        $('#ModalFormCreate form')
            .find('[name="roles[]"]')
            .change(function(e) {
                /* Revalidate the language when it is changed */
                $('#ModalFormCreate form').formValidation('revalidateField', 'roles[]');
            })
            .end()
            .formValidation({
            framework: "bootstrap4",
            fields: {
                name: {
                    validators: {
                        notEmpty: {
                            message: 'The name is required'
                        },
                        stringLength: {
                            min: 3,
                            max: 50
                        }
                    }
                },
                email: {
                    validators: {
                        notEmpty: {
                            message: 'The username is required'
                        },
                        emailAddress: {
                            message: 'The email address is not valid'
                        }
                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: 'The password is required'
                        },
                        stringLength: {
                            min: 8
                        }
                    }
                },
                enable: {
                    validators: {
                        notEmpty: {
                            message: 'Choose enable or disable'
                        }
                    }
                },
                'roles[]': {
                    validators: {
                        notEmpty: {
                            message: 'Please select user roles'
                        }
                    }
                }
            }
        }).on('success.form.fv', function (e) {
            /*e.preventDefault();
            var $form = $(e.target);
            var id = $form.attr('id');
            var data = $form.serialize();
            UsersModule.handleStore(data);
            $('#ModalFormCreate form').data('formValidation').resetForm(true);
            $('#ModalFormCreate').modal('hide');*/
        });
    })();
    //-------------------------------------------
})(document, window, jQuery);
//-------------------------------------------


