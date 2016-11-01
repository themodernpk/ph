(function (document, window, $) {
    'use strict';
    var RoleModule = {
        data: {},
        //----------------------------------------
        init: function () {
            var current_url = $("input[name=url_current]").val();
            this.data.url = {
                current: current_url,
                list: current_url + "/list/?",
                read: current_url + "/read/",
                toggle: current_url + "/toggle/",
                store: current_url + "/store/",
                delete: current_url + "/delete/",
                restore: current_url + "/restore/",
                deletePermanent: current_url + "/delete/permanent/"
            };
        },
        //----------------------------------------
        fetchList: function (page) {
            var url = RoleModule.data.url.list;
            if (page === undefined) {
                url += "page=1";
            } else {
                url += "page=" + page;
            }
            var s = $(".search").val();
            if (s != "") {
                url += "&s=" + s;
            }
            var trashed = $("input[name=trashed]").val();
            console.log(trashed);
            if (trashed == 1) {
                url += "&trashed=" + trashed;
            }
            $.ajax({
                url: url,
            }).done(function (response) {
                var html = RoleModule.templateItem(response.list.data);
                $("#list").html(html);
                $("#trashCount").html(response.trashCount);
                RoleModule.handlePagination(response.list);
                if (s != "") {
                    $("#list").highlight(s);
                }
            });
        },
        //----------------------------------------
        templateItem: function (list) {
            var html = "";
            $.each(list, function (index, object) {
                if (object.enable == 1) {
                    object.enable = "Yes";
                    object.class = "btn-success"
                } else {
                    object.enable = "No";
                    object.class = "btn-danger"
                }
                var deleted = "";
                if (object.deleted_at) {
                    deleted = '<span class="tag tag-danger">Deleted</span>';
                }
                html += `
                    <tr class="" data-id="` + object.id + `">
                        <td>
                          <span class="checkbox-custom checkbox-primary">
                            <input class="selectable-item" type="checkbox" 
                            value="` + object.id + `">
                            <label for="row-` + object.id + `"></label>
                          </span>
                        </td>
                        <td class="hidden-sm-down">` + object.id + `</td>
                        <td>` + deleted + ` ` + object.name + `</td>
                        <td><button class="btn btn-xs enableToggle ` + object.class + `">` + object.enable + `</button>                        
                        </td>
                        <td class="hidden-sm-down">` + object.slug + `</td>
                        <td class="hidden-sm-down">` + object.users_count + `</td>
                        <td class="hidden-sm-down">` + object.permissions_count + `</td>
                        <td>
                        <a href="` + RoleModule.data.url.read + object.id + `"
                        target="_blank"
                        class="btn btn-sm btn-icon btn-flat btn-default">
                            <i class="icon wb-eye" aria-hidden="true"></i>
                          </a>
                          
                          <a href="` + RoleModule.data.url.delete + object.id + `"
                             class="btn btn-sm btn-icon btn-flat btn-default itemDelete">
                            <i class="icon wb-trash" aria-hidden="true"></i>
                          </a>
                        </td>
                    </tr>
                `;
            });
            return html;
        },
        //----------------------------------------
        handlePagination: function (data) {
            RoleModule.handleSelectAllReset();
            var total = parseFloat(data.total);
            $(".pagination_con").paging(total, {
                format: '[< nncnn >]',
                perpage: data.per_page,
                lapping: 0,
                page: data.current_page,
                onSelect: function (page) {
                    if (page != data.current_page) {
                        RoleModule.fetchList(page);
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
        handleToggle: function () {
            $("body").on("click", ".enableToggle", function (e) {
                e.preventDefault();
                var id = $(this).closest("tr").attr("data-id");
                RoleModule.handleToggleEnable(id);
            });
        },
        //----------------------------------------
        handleToggleEnable: function (id, status) {
            var data = {};
            data.id = id;
            if (status !== undefined) {
                data.enable = status;
            }
            RoleModule.handleAjax(RoleModule.data.url.toggle, RoleModule.fetchList, {id: id}, 'POST');
        },
        //----------------------------------------
        bulkDisable: function () {
            $("body").on("click", ".bulkDisable", function (e) {
                e.preventDefault();
                var list = $("#list").find(".selectable-item");
                $.each(list, function (index, item) {
                    var check = $(item).prop('checked');
                    if (check == true) {
                        var id = $(item).closest("tr").attr("data-id");
                        RoleModule.handleAjax(RoleModule.data.url.toggle, false, {id: id, enable: 0}, 'POST');
                    }
                });
                RoleModule.fetchList();
            });
        },
        //----------------------------------------
        bulkEnable: function () {
            $("body").on("click", ".bulkEnable", function (e) {
                e.preventDefault();
                var list = $("#list").find(".selectable-item");
                $.each(list, function (index, item) {
                    var check = $(item).prop('checked');
                    if (check == true) {
                        var id = $(item).closest("tr").attr("data-id");
                        RoleModule.handleAjax(RoleModule.data.url.toggle, false, {id: id, enable: 1}, 'POST');
                    }
                });
                RoleModule.fetchList();
            });
        },
        //----------------------------------------
        handleSearch: function () {
            $("body").on("keyup blur", ".search", function (e) {
                e.preventDefault();
                RoleModule.fetchList();
            });
        },
        //----------------------------------------
        handleSelectAll: function () {
            $("body").on("click", ".selectable-all", function (e) {
                var state = $(this).is(":checked");
                var list = $(this).closest("table").find(".selectable-item");
                $.each(list, function (index, item) {
                    $(item).prop("checked", state);
                });
            });
        },
        //----------------------------------------
        handleSelectAllReset: function () {
            $(".selectable-all").prop("checked", false);
        },
        //----------------------------------------
        handleStore: function (data) {
            RoleModule.handleAjax(RoleModule.data.url.store, RoleModule.fetchList, data, 'POST');
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
        handleDelete: function () {
            $("body").on("click", ".itemDelete", function (e) {
                e.preventDefault();
                var url = $(this).attr("href");
                RoleModule.handleAjax(url, RoleModule.fetchList);
            });
        },
        //----------------------------------------
        bulkDelete: function () {
            $("body").on("click", ".bulkDelete", function (e) {
                e.preventDefault();
                var list = $("#list").find(".selectable-item");
                $.each(list, function (index, item) {
                    var check = $(item).prop('checked');
                    if (check == true) {
                        var id = $(item).closest("tr").attr("data-id");
                        RoleModule.handleAjax(RoleModule.data.url.delete + id, RoleModule.fetchList)
                    }
                });
            });
        },
        //----------------------------------------
        bulkDeletePermanent: function () {
            $("body").on("click", ".bulkDeletePermanent", function (e) {
                e.preventDefault();
                var list = $("#list").find(".selectable-item");
                $.each(list, function (index, item) {
                    var check = $(item).prop('checked');
                    if (check == true) {
                        var id = $(item).closest("tr").attr("data-id");
                        RoleModule.handleAjax(RoleModule.data.url.deletePermanent + id, RoleModule.fetchList)
                    }
                });
            });
        },
        //----------------------------------------
        bulkRestore: function () {
            $("body").on("click", ".bulkRestore", function (e) {
                e.preventDefault();
                var list = $("#list").find(".selectable-item");
                $.each(list, function (index, item) {
                    var check = $(item).prop('checked');
                    if (check == true) {
                        var id = $(item).closest("tr").attr("data-id");
                        RoleModule.handleAjax(RoleModule.data.url.restore + id, RoleModule.fetchList)
                    }
                });
            });
        },
        //----------------------------------------
        handleToggleTrashed: function () {
            $("body").on("click", "#showTrashed", function (e) {
                e.preventDefault();
                $(this).find('.showTrashedChecked').toggle();
                var hiddenField = $('input[name=trashed]');
                var val = hiddenField.val();
                if (val == 1) {
                    hiddenField.val(0);
                } else {
                    hiddenField.val(1);
                }
                RoleModule.fetchList();
            });
        },
        //----------------------------------------
        run: function () {
            var self = this;
            this.init();
            this.fetchList();
            this.handleToggle();
            this.handleSearch();
            this.handleSelectAll();
            this.handleSelectAllReset();
            this.handleDelete();
            this.handleToggleTrashed();
            this.bulkEnable();
            this.bulkDisable();
            this.bulkDelete();
            this.bulkDeletePermanent();
            this.bulkRestore();
        }
        //----------------------------------------
    };
    //-------------------------------------------
    $(document).ready(function () {
        RoleModule.run();
    });
    //-------------------------------------------
    //########### Form Validation
    (function () {
        $('#ModalFormCreate form').formValidation({
            framework: "bootstrap4",
            fields: {
                name: {
                    validators: {
                        notEmpty: {
                            message: 'The name is required'
                        },
                    }
                }
            }
        }).on('success.form.fv', function (e) {
            e.preventDefault();
            var $form = $(e.target);
            var id = $form.attr('id');
            var data = $form.serialize();
            RoleModule.handleStore(data);
            $('#ModalFormCreate form').data('formValidation').resetForm(true);
            $('#ModalFormCreate').modal('hide');
        });
    })();
    //-------------------------------------------
})(document, window, jQuery);
//-------------------------------------------


