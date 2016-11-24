(function (document, window, $) {
    'use strict';
    var PermissionModule = {
        data: {},
        //----------------------------------------
        init: function () {
            var current_url = $("input[name=url_current]").val();
            this.data.url = {
                current: current_url,
                list: current_url+"/list/?",
                read: current_url+"/read/",
                toggle: current_url+"/toggle/"
            };
        },
        //----------------------------------------
        fetchList: function (page) {
            var url = this.data.url.list;
            if (page === undefined) {
                url += "page=1";
            } else {
                url += "page=" + page;
            }
            var s = $(".search").val();
            if (s != "") {
                url += "&s=" + s;
            }
            $.ajax({
                url: url,
            }).done(function (response) {
                var html = PermissionModule.templateItem(response.data);
                $("#list").html(html);
                PermissionModule.handlePagination(response);
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
                        <td class="hidden-sm-down">` + object.prefix + `</td>
                        <td>` + object.name + `</td>
                        <td><button class="btn btn-xs enableToggle ` + object.class + `">` + object.enable + `</button></td>
                        <td class="hidden-sm-down">` + object.slug + `</td>
                        <td class="hidden-sm-down">` + object.roles_count + `</td>
                        <td>
                        <a href="`+PermissionModule.data.url.read+object.id+`"
                        class="btn btn-sm btn-icon btn-flat btn-default slide-panel">
                            <i class="icon wb-eye" aria-hidden="true"></i>
                          </a>
                        </td>
                    </tr>
                `;
            });
            return html;
        },
        //----------------------------------------
        handlePagination: function (data) {
            PermissionModule.handleSelectAllReset();
            var total = parseFloat(data.total);
            $(".pagination_con").paging(total, {
                format: '[< nncnn >]',
                perpage: data.per_page,
                lapping: 0,
                page: data.current_page,
                onSelect: function (page) {
                    if (page != data.current_page) {
                        PermissionModule.fetchList(page);
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
                PermissionModule.handleToggleEnable(id);
            });
        },
        //----------------------------------------
        handleToggleEnable: function (id, status) {
            var data = {};
            data.id = id;
            if (status !== undefined) {
                data.enable = status;
            }
            NProgress.start();
            $.ajax({
                method: "POST",
                url: PermissionModule.data.url.toggle,
                data: data,
                async: true,
                context: this
            }).done(function (response) {

                NProgress.done();
                if (response.status == "success") {
                    if (response.data.enable == "1") {
                        $("tr[data-id=" + id + "]").find(".enableToggle").text("Yes")
                            .addClass("btn-success")
                            .removeClass("btn-danger");
                    } else {
                        $("tr[data-id=" + id + "]").find(".enableToggle").text("No")
                            .addClass("btn-danger")
                            .removeClass("btn-success");
                    }
                } else {
                    $.each(response.errors, function (index, object) {
                        alertify.error(object);
                    });
                }
            });
        },
        //----------------------------------------
        bulkDisable: function () {
            $("body").on("click", ".bulkDisable", function (e) {
                e.preventDefault();
                var list = $("#list").find(".selectable-item");
                $.each(list, function (index, item) {
                    var check = $(item).prop('checked');
                    if(check == true)
                    {
                        var id = $(item).closest("tr").attr("data-id");
                        PermissionModule.handleToggleEnable(id, 0);
                    }
                });
            });
        },
        //----------------------------------------
        bulkEnable: function () {
            $("body").on("click", ".bulkEnable", function (e) {
                e.preventDefault();
                var list = $("#list").find(".selectable-item");


                $.each(list, function (index, item) {
                    var check = $(item).prop('checked');
                    if(check == true)
                    {
                        var id = $(item).closest("tr").attr("data-id");
                        PermissionModule.handleToggleEnable(id, 1);
                    }
                });
            });
        },
        //----------------------------------------
        handleSearch: function () {
            $("body").on("keyup blur", ".search", function (e) {
                e.preventDefault();
                PermissionModule.fetchList();
            });
        },
        //----------------------------------------
        handleDelete: function () {
            $("body").on("click", ".deleteItem", function (e) {
                e.preventDefault();
                PermissionModule.fetchList();
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
        run: function () {
            var self = this;
            this.init();
            this.fetchList();
            this.handleToggle();
            this.handleSearch();
            this.handleDelete();
            this.handleSelectAll();
            this.bulkDisable();
            this.bulkEnable();
            this.handleSelectAllReset();
        }
        //----------------------------------------
    };
    //-------------------------------------------
    $(document).ready(function () {
        PermissionModule.run();
    });
    //-------------------------------------------
    //-------------------------------------------
})(document, window, jQuery);