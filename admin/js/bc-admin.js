jQuery(document).ready(function ($) {

    class ticketClass {
        constructor() {
        }

        static url = "http://localhost/my-api/public/";

        static save_data_ticket() {
            $(".onprocess-form").css("display", "flex");

            var idreg = $("#save-data-ticket").data("idreg");
            var estado = $("#cod_estado").val();
            var des_ticket = $("#des_ticket").val();
            var cod_mer = $("#cod_mer").val();

            var dataSend = {
                idreg: idreg,
                cod_user: cod_mer,
                des_ticket: des_ticket,
                cod_estado: estado
            };

            $.ajax({
                url: this.url + "ticketUpdate",
                method: 'post',
                dataType: 'json',
                data: dataSend,
                success: function (data) {
                    ticketClass.save_data_ticket_success(data.data);
                },
                error: function (xhr, status) {
                    ticketClass.save_data_ticket_error();
                }
            });
        };
        static save_data_new_ticket(dataSend) {
            $(".onprocess-form").css("display", "flex");

            $.ajax({
                url: this.url + "tickets",
                method: 'post',
                dataType: 'json',
                data: dataSend,
                success: function (data) {
                    ticketClass.save_data_new_ticket_success(data);
                    var dataTable = tableRefsTicket.getDataTable();
                    if (tableRefsTicket.validateDataTable(dataTable)) {
                        dataTable.forEach(ref => {
                            dataSend = {
                                idreg_ticket: data.data.idreg,
                                cod_ref: ref[0],
                                cantidad: ref[1],
                                val_uni: ref[2]
                            }
                            tableRefsTicket.save_data_table_ticket(dataSend);
                        });
                    };
                },
                error: function (xhr, status) {
                    ticketClass.save_data_new_ticket_error();
                }
            });

            return dataSend;
        };
        static validate_data_ticket() {
            var estado = $("#cod_estado").val();
            var des_ticket = $("#des_ticket").val();
            var cod_mer = $("#cod_mer").val();

            if ($("#nom_mer").hasClass("is-invalid")) {
                return false;
            } else {
                return true;
            }
        };
        static validate_data_new_ticket() {
            var dataSend = {
                cod_type: $("#cod_type").val(),
                cod_ter: $("#cod_ter").val(),
                title_ticket: $("#title_ticket").val(),
                des_ticket: $("#des_ticket").val(),
                cod_user: $("#cod_mer").val(),
                cod_ref: $("#cod_ref").val(),
                cod_pipeline: "1",
                cod_estado: "0",
                cod_creator: $("#create-new-ticket").data("creator")
            }

            if (
                $("#nom_ref").hasClass("is-invalid") &
                $("#nom_mer").hasClass("is-invalid")
            ) {
                return false;
            } else {
                return dataSend;
            }
        };
        static change_cod_ref(cod_ref) {
            var dataSend = {
                sku: cod_ref
            }
            $.ajax({
                url: this.url + "product",
                method: 'post',
                dataType: 'json',
                data: dataSend,
                success: function (data) {
                    if (data.data.length == 0) {
                        ticketClass.change_cod_ref_error();
                    } else {
                        ticketClass.change_cod_ref_success(data.data[0]);
                    };
                },
                error: function (xhr, status) {
                    console.log("Error");
                }
            });
        };
        static change_cod_mer(cod_mer) {
            var dataSend = {
                cod_mer: cod_mer
            }
            $.ajax({
                url: this.url + "user",
                method: 'post',
                dataType: 'json',
                data: dataSend,
                success: function (data) {
                    if (data.data.length == 0) {
                        ticketClass.change_cod_mer_error();
                    } else {
                        ticketClass.change_cod_mer_success(data.data[0]);
                    };
                },
                error: function (xhr, status) {
                    console.log("Error");
                }
            });
        };
        static change_cod_mer_success(data) {
            $("#nom_mer").val(data.nom_mer);
            $(".error-cod-mer").hide();
            $(".success-cod-mer").show();
            $("#nom_mer").removeClass("is-invalid");
            $("#nom_mer").addClass("is-valid");
        };
        static change_cod_mer_error() {
            $("#nom_mer").val("");
            $("#nom_mer").removeClass("is-valid");
            $("#nom_mer").addClass("is-invalid");
            $(".success-cod-mer").hide();
            $(".error-cod-mer").show();
        };
        static change_cod_ref_success(data) {
            $("#nom_ref").val(data.nom_ref);
            $(".error-cod-ref").hide();
            $(".success-cod-ref").show();
            $("#nom_ref").removeClass("is-invalid");
            $("#nom_ref").addClass("is-valid");
        };
        static change_cod_ref_error() {
            $("#nom_ref").val("");
            $("#nom_ref").removeClass("is-valid");
            $("#nom_ref").addClass("is-invalid");
            $(".success-cod-ref").hide();
            $(".error-cod-ref").show();
        };
        static save_data_ticket_success(data) {
            $(".onprocess-form").css("display", "none");
            $(".error-save-ticket").hide();
            $(".success-save-ticket").show();

            switch (data.cod_estado) {
                case '0':
                    $("#badge-estado").html('<span class="badge bg-info">Pendiente</span>');
                    break;
                case '1':
                    $("#badge-estado").html('<span class="badge bg-warning">En proceso</span>');
                    break;
                case '2':
                    $("#badge-estado").html('<span class="badge bg-success">Vendido</span>');
                    break;
                case '3':
                    $("#badge-estado").html('<span class="badge bg-danger">Venta perdidá</span>');
                    break;
            }
        };
        static save_data_ticket_error() {
            $(".onprocess-form").css("display", "none");
            $(".error-form-ticket").show();
            $(".error-form-ticket").html("Se ha presentado un error.");
        };
        static save_data_new_ticket_success(data) {
            $(".onprocess-form").css("display", "none");
            $(".success-form-ticket").html("Se ha guardado la información.");
            $(".success-form-ticket").show();

            setTimeout(function () {
                $(".success-form-ticket").html();
                $(".success-form-ticket").hide();
                $("#cod_ter").val("");
                $("#title_ticket").val("");
                $("#des_ticket").val("");
                $("#cod_mer").val("");
                $("#nom_mer").val("");
                $("#cod_ref").val("");
                $("#nom_ref").val("");
                $(".error-cod-mer").hide();
                $(".success-cod-mer").hide();
            }, 3000);

            $(".text-url-ticket").show();
            $(".text-url-ticket a").attr("href", window.location.href.split("?")[0] + "?" + arrayDeCadenas[0] + "&sub-page=page-ticket&id-ticket="+data.data.idreg);
        };
        static save_data_new_ticket_error() {
            $(".onprocess-form").css("display", "none");
            $(".alert-success").hide();
            $(".alert-error").show();
        };
    }

    class tableRefsTicket {
        constructor() {
        }

        static selectorHTML = "#table-references-ticket";

        static initTableRef() {
            $("#table-references-ticket tbody tr").each(function (index, element) {

                $(element).find('.cod_ref').on("keydown", null, [index, element], function (event) {

                    if (
                        event.originalEvent.keyCode == 46
                    ) {
                        event.data[1].remove()
                        tableRefsTicket.initTableRef();
                        tableRefsTicket.selectRowEdit();
                    }
                });

                $(element).find('.cantidad').on("keypress", null, [index, element], function (event) {
                    var keyNumber = new Array(46, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57);

                    if (keyNumber.indexOf(event.originalEvent.keyCode) == -1) {
                        event.preventDefault();
                    }
                });

                $(element).find('.val_uni').on("keypress", null, [index, element], function (event) {

                    var keyNumber = new Array(48, 49, 50, 51, 52, 53, 54, 55, 56, 57);

                    if (keyNumber.indexOf(event.originalEvent.keyCode) == -1) {
                        event.preventDefault();
                    }

                    if (
                        event.originalEvent.keyCode == 13 &&
                        $("#table-references-ticket tbody tr").length == index + 1 &&
                        $(element).find(".cod_ref").val().trim().length != 0
                    ) {
                        event.preventDefault();
                        var num_rows = $("#table-references-ticket tbody tr").length;
                        var stringHtml = '<tr class="row-form row-';
                        stringHtml += num_rows + 1
                        stringHtml += '">';
                        stringHtml += '<td>';
                        stringHtml += '<input type="text" class="form-control rounded-1 text-left cod_ref" value="">'
                        stringHtml += '</td>'
                        stringHtml += '<td>'
                        stringHtml += '<input type="text" class="form-control rounded-1 text-left nom_ref" value="" disabled>'
                        stringHtml += '</td>'
                        stringHtml += '<td>'
                        stringHtml += '<input type="text" class="form-control rounded-1 text-center cantidad" value="1">'
                        stringHtml += '</td>'
                        stringHtml += '<td>'
                        stringHtml += '<input type="text" class="form-control rounded-1 text-right val_uni" value="0">'
                        stringHtml += '</td>'
                        stringHtml += '</tr>'
                        var resultRow = $(stringHtml).appendTo("#table-references-ticket tbody");
                        tableRefsTicket.initTableRef();
                        tableRefsTicket.selectRowEdit();
                    }


                });

                $(element).find('.val_uni').on("keyup", null, [index, element], function (event) {
                    var val_uni = $(element).find('.val_uni').val().replaceAll(".", "")
                    var val_uni_format = new Intl.NumberFormat("es-CL").format(val_uni)
                    $(element).find('.val_uni').val(val_uni_format);

                });

                $(element).find('.val_uni').on("change", null, [index, element], function (event) {
                    var val_uni = $(element).find('.val_uni').val().replaceAll(".", "")
                    var val_uni_format = new Intl.NumberFormat("es-CL").format(val_uni)
                    $(element).find('.val_uni').val(val_uni_format);
                });

                $(element).find('.cod_ref').on("change", null, [index, element], function (event) {
                    var cod_ref = $(element).find(".cod_ref").val().trim();

                    var dataSend = {
                        sku: cod_ref
                    }

                    $.ajax({
                        url: ticketClass.url + "product",
                        method: 'post',
                        dataType: 'json',
                        data: dataSend,
                        success: function (data) {
                            if (data.data.length == 0) {
                                tableRefsTicket.change_cod_ref_error(element);
                            } else {
                                tableRefsTicket.change_cod_ref_success(data.data[0], element);
                            };
                        },
                        error: function (xhr, status) {
                            console.log("Error");
                        }
                    });
                });
            });
        };

        static change_cod_ref_error(element) {
            $(element).find(".nom_ref").val("");
            $(element).find(".nom_ref").addClass("is-invalid");
            $(element).find(".nom_ref").removeClass("is-valid");
        };

        static change_cod_ref_success(data, element) {
            $(element).find(".val_uni").val(data.val_ref)
            $(element).find(".nom_ref").val(data.nom_ref)
            $(element).find(".nom_ref").addClass("is-valid");
            $(element).find(".nom_ref").removeClass("is-invalid");
        };

        static selectRowEdit() {
            $("#table-references-ticket tbody tr").each(function (index, element) {
                $(element).find("input")
                    .on("focus", null, [index, element], function (event) {

                        $(event.data[1]).addClass("bg-gray")

                    })
                    .on("focusout", null, [index, element], function (event) {

                        $(event.data[1]).removeClass("bg-gray")

                    })
            })
        };

        static getDataTable() {
            var dataTable = []
            $("#table-references-ticket tbody tr").each(function (index, element) {
                if ($(element).find('.nom_ref').hasClass("is-valid")) {
                    var cod_ref = $(element).find('.cod_ref').val();
                    var cantidad = parseInt($(element).find('.cantidad').val());
                    var val_ref = parseInt($(element).find('.val_uni').val().replaceAll(".", ""));
                    dataTable.push([cod_ref, cantidad, val_ref])
                } else {
                    dataTable.push([false, false, false])
                };
            });
            return dataTable;
        };

        static validateDataTable(dataTable) {
            var result = true
            dataTable.forEach(row => {
                if (row[0] == false) {
                    result = false
                }
            });
            if (result == false) {
                $(".error-table-ref").show()
            }
            return result;
        };

        static save_data_table_ticket(dataTable) {
            $.ajax({
                url: ticketClass.url + "ticketRef",
                method: 'post',
                dataType: 'json',
                data: dataTable,
                success: function (data) {
                    tableRefsTicket.reset_form_data(data.data);
                },
                error: function (xhr, status) {
                    console.log(xhr, status);
                }
            });
        }

        static reset_form_data(data) {
            $(".success-form-ticket").show();
            $(".success-form-ticket").html("Se ha guardado la información de la ref. "+data.cod_ref+" x "+data.cantidad+" unidades ");
            
            setTimeout(function () {
                $(".success-form-ticket").hide();
                $(".success-form-ticket").html("");
            }, 2000);
        }
    }

    tableRefsTicket.initTableRef("#table-references-ticket");

    var arrayDeCadenas = window.location.href.split("?")[1].split("&");

    if (arrayDeCadenas[0] == "page=mys_crm_hub") {

        $(".update-nag").css("display", "none");
        $("#adminmenumain").css("display", "none");
        $("#wpcontent").css("margin-left", "0");
        $("#wpcontent").css("padding-left", "0");
        $("#wpbody-content").css("padding-bottom", "0");
        $("#wpfooter").css("display", "none");

        if (arrayDeCadenas.indexOf('sub-page=clientes') == -1) {
            $(".item-menu-clientes a").attr("href", window.location.href.split("?")[0] + "?" + arrayDeCadenas[0] + "&sub-page=clientes");
        }

        if (arrayDeCadenas.indexOf('sub-page=productos') == -1) {
            $(".item-menu-productos a").attr("href", window.location.href.split("?")[0] + "?" + arrayDeCadenas[0] + "&sub-page=productos");
        }

        if (arrayDeCadenas.indexOf('sub-page=tickets') == -1) {
            $(".item-menu-tickets a").attr("href", window.location.href.split("?")[0] + "?" + arrayDeCadenas[0] + "&sub-page=tickets");
        }

        $(".card-crm-motos").css("margin-top", "0");
        $(".card-crm-motos").css("padding", "0");
        $(".card-crm-motos").css("max-width", "inherit");
        $(".card-crm-motos").css("box-sizing", "inherit");

        $(".card-crm-products-rigth").css("max-width", "none");
        $(".card-crm-products-rigth").css("padding", "0");
        $(".card-crm-products-left").css("padding", "0");
        $(".alert-crm").css("padding", ".75rem 1.25rem");
        $(".card-buttons-product").css("padding", "1rem");
        $(".card-buttons-product .btn").css("margin", "0");

        //$("").css("","");
        $(".form-create-ticket").css("max-width", "1200px");
        $(".form-create-ticket").css("margin-top", "4rem");
        $(".form-create-ticket select").css("max-width", "inherit");

        if (arrayDeCadenas.indexOf('sub-page=page-product') != -1) {
            $("#tickets-product").DataTable({
                "paging": true,
                "responsive": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "buttons": ["colvis"]
            }).buttons().container().appendTo('#tickets-product_wrapper .col-md-6:eq(0)');
        }

        if (arrayDeCadenas.indexOf('sub-page=productos') != -1) {
            $("#products-page").DataTable({
                "paging": true,
                "responsive": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "buttons": ["colvis"]
            }).buttons().container().appendTo('#products-page_wrapper .col-md-6:eq(0)');
        }

        if (arrayDeCadenas.indexOf('sub-page=page-customer') != -1) {
            $("#tickets-product").DataTable({
                "paging": true,
                "responsive": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "buttons": ["colvis"]
            }).buttons().container().appendTo('#tickets-product_wrapper .col-md-6:eq(0)');
        }

        if (arrayDeCadenas.indexOf('sub-page=clientes') != -1) {
            $("#customer-page").DataTable({
                "paging": true,
                "responsive": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "buttons": ["colvis"]
            }).buttons().container().appendTo('#customer-page_wrapper .col-md-6:eq(0)');
        }

        if (arrayDeCadenas.indexOf('sub-page=tickets') != -1) {
            $("#ticket-page").DataTable({
                "paging": true,
                "responsive": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "buttons": ["colvis"]
            }).buttons().container().appendTo('#ticket-page_wrapper .col-md-6:eq(0)');
        }

        $("#save-data-ticket").on("click", function (e) {
            e.preventDefault();

            var validate = ticketClass.validate_data_ticket();
            if (validate) {
                ticketClass.save_data_ticket(validate);
            }
        });

        $("#create-new-ticket").on("click", function (e) {
            e.preventDefault();

            var validate = ticketClass.validate_data_new_ticket();
            if (validate) {
                ticketClass.save_data_new_ticket(validate);
            }
        });

        $("#cod_mer").on("change", function () {
            var cod_mer = $("#cod_mer").val();
            ticketClass.change_cod_mer(cod_mer);
        });

        $("#description").addClass("active");

        $("#tickets").addClass("active");

        $("#cod_ref").on("change", function () {
            var cod_mer = $("#cod_ref").val();
            ticketClass.change_cod_ref(cod_mer);
        });
    }
})