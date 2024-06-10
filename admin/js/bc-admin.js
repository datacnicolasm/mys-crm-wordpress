jQuery(document).ready(function ($) {

    class ticketClass {
        constructor() {
        }

        static url = "http://localhost/my-api/public/";

        /**
         * Actualizar información de un ticket existente.
         */
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
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Authorization', '9c296f109cbfa21632dc522a3aade323');
                },
                success: function (data) {
                    ticketClass.save_data_ticket_success(data.data);
                },
                error: function (xhr, status) {
                    ticketClass.save_data_ticket_error();
                }
            });
        };

        /**
         * Function para guardar un Ticket nuevo.
         * 
         * @param {TicketData} dataSend 
         * @returns 
         */
        static save_data_new_ticket(dataSend) {
            $(".onprocess-form").css("display", "flex");

            $.ajax({
                url: this.url + "tickets",
                method: 'post',
                dataType: 'json',
                data: dataSend,
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Authorization', '9c296f109cbfa21632dc522a3aade323');
                },
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

        /**
         * Function para validar información de un ticket
         * 
         * @returns 
         */
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

        /**
         * Function para obtener el correo del usuario de SIASOFT
         * 
         * @param {id} id 
         */
        static get_email_user_wp(id) {
            $.ajax({
                url: object_ajax.url,
                method: 'POST',
                data: {
                    action: 'get_email_user_wp',
                    security: object_ajax.token,
                    id: id
                },
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Authorization', '9c296f109cbfa21632dc522a3aade323');
                },
                success: function (response) {
                    ticketClass.validate_data_new_ticket(response.data.email)
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }


        /**
         * Clase para validar campos del formulario y si todo es correcto
         * se ejecuta la clase que envia datos a la API para registrar el
         * nuevo ticket.
         * 
         * @param {mail} mail_user 
         * @returns 
         */
        static validate_data_new_ticket(mail_user) {
            var dataSend = {
                cod_type: $("#cod_type").val(),
                cod_ter: $("#cod_ter").val(),
                title_ticket: $("#title_ticket").val(),
                des_ticket: $("#des_ticket").val(),
                cod_user: $("#cod_mer").val(),
                cod_ref: $("#cod_ref").val(),
                cod_pipeline: "1",
                cod_estado: "0",
                cod_creator: $("#create-new-ticket").data("creator"),
                mail_user: mail_user
            }

            if (
                $("#nom_ref").hasClass("is-invalid") &
                $("#nom_mer").hasClass("is-invalid")
            ) {
                return false;
            } else {
                ticketClass.save_data_new_ticket(dataSend)
            }
        };

        /**
         * Function cuando cambia el codigo del vendedor de un ticket existente.
         * 
         * @param {CodMer} cod_mer 
         */
        static change_cod_mer(cod_mer) {
            var dataSend = {
                cod_mer: cod_mer
            }
            $.ajax({
                url: this.url + "user",
                method: 'post',
                dataType: 'json',
                data: dataSend,
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Authorization', '9c296f109cbfa21632dc522a3aade323');
                },
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

        /**
         * Function cuando el nuevo codigo de vendedor para un ticket si existe.
         * 
         * @param {DataMer} data 
         */
        static change_cod_mer_success(data) {
            $("#nom_mer").val(data.nom_mer);
            $(".error-cod-mer").hide();
            $(".success-cod-mer").show();
            $("#nom_mer").removeClass("is-invalid");
            $("#nom_mer").addClass("is-valid");

            setTimeout(function () {
                $(".success-cod-mer").hide();
            }, 3000);
        };

        /**
         * Function de error cuando el codigo de vendedor de un cliente no existe.
         */
        static change_cod_mer_error() {
            $("#nom_mer").val("");
            $("#nom_mer").removeClass("is-valid");
            $("#nom_mer").addClass("is-invalid");
            $(".success-cod-mer").hide();
            $(".error-cod-mer").show();
        };

        /**
         * Function cuando la información del ticket es actualizada con exito.
         * 
         * @param {Ticket} data 
         */
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

            setTimeout(function () {
                $("#nom_mer").removeClass("is-valid");
                $(".success-save-ticket").hide();
            }, 5000);
        };

        /**
         * Function cuando el ticket no se puede actualizar y genera error.
         */
        static save_data_ticket_error() {
            $(".onprocess-form").css("display", "none");
            $(".error-form-ticket").show();
            $(".error-form-ticket").html("Se ha presentado un error.");
        };

        /**
         * Function cuando el ticket se crea con exito.
         * 
         * @param {Ticket} data 
         */
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
            $(".text-url-ticket a").attr("href", window.location.href.split("?")[0] + "?" + arrayDeCadenas[0] + "&sub-page=page-ticket&id-ticket=" + data.data.idreg);
        };

        /**
         * Function cuando el ticket no se puede crear por un error.
         */
        static save_data_new_ticket_error() {
            $(".onprocess-form").css("display", "none");
            $(".alert-success").hide();
            $(".alert-error").show();
        };
    }

    class addReferencesTicket {
        constructor() { }

        static selectorHTML = "#table_add_referencia";

        /**
         * Funciton cuando los datos retornados por la API no estan bien
         */
        static getReferenceError() {
            $(".success-cod-referencia").hide()
            $(".error-cod-referencia").show()
            $(addReferencesTicket.selectorHTML).find(".nom_ref").addClass("is-invalid");
        }

        /**
         * Function cuando los datos retornados por la API estan bien.
         * 
         * @param {data} data 
         */
        static getReferencesuccess(data) {
            $(addReferencesTicket.selectorHTML).find(".nom_ref").val(data.nom_ref)
            $(addReferencesTicket.selectorHTML).find(".nom_ref").addClass("is-valid");
            $(addReferencesTicket.selectorHTML).find(".nom_ref").removeClass("is-invalid");

            var val_uni_format = new Intl.NumberFormat("es-CL").format(data.val_ref)
            $(addReferencesTicket.selectorHTML).find(".val_uni").val(val_uni_format)

            $(".error-cod-referencia").hide()
            $(".success-cod-referencia").show()
        }

        /**
         * Function para inicializar la tabla del formulario para referencias
         */
        static initTableRef() {
            $(this.selectorHTML).find('.cod_ref').on("change", function (event) {
                var cod_ref = $(addReferencesTicket.selectorHTML).find('.cod_ref').val().trim();

                var dataSend = {
                    sku: cod_ref
                }

                $.ajax({
                    url: ticketClass.url + "product",
                    method: 'post',
                    dataType: 'json',
                    data: dataSend,
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('Authorization', '9c296f109cbfa21632dc522a3aade323');
                    },
                    success: function (data) {
                        addReferencesTicket.getReferencesuccess(data.data);
                    },
                    error: function (xhr, status) {
                        addReferencesTicket.getReferenceError()
                    }
                });
            });

            $(this.selectorHTML).find('.val_uni').on("keyup", function (event) {
                var val_uni = $(addReferencesTicket.selectorHTML).find('.val_uni').val().replaceAll(".", "")
                var val_uni_format = new Intl.NumberFormat("es-CL").format(val_uni)
                $(addReferencesTicket.selectorHTML).find('.val_uni').val(val_uni_format);
            });

            $(this.selectorHTML).find('.val_uni').on("keydown", function (event) {

                if (event.originalEvent.keyCode == 13) {
                    var dataSend = {
                        idreg_ticket: $(addReferencesTicket.selectorHTML).data('ticket'),
                        cod_ref: $(addReferencesTicket.selectorHTML).find('.cod_ref').val(),
                        cantidad: $(addReferencesTicket.selectorHTML).find('.cantidad').val(),
                        val_uni: $(addReferencesTicket.selectorHTML).find('.val_uni').val().replaceAll(".", ""),
                        cod_creator: $('#cod_creator').val()
                    }

                    addReferencesTicket.save_ref_ticket(dataSend);
                }

            });
        }

        /**
         * Function AJAX para enviar información de la nueva referencia
         * 
         * @param {dataTable} dataTable 
         */
        static save_ref_ticket(dataTable) {
            $.ajax({
                url: ticketClass.url + "ticketRef",
                method: 'post',
                dataType: 'json',
                data: dataTable,
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Authorization', '9c296f109cbfa21632dc522a3aade323');
                },
                success: function (data) {
                    addReferencesTicket.save_ref_ticket_success(data.data);
                },
                error: function (xhr, status) {
                    console.log(xhr, status);
                }
            });
        }

        static save_ref_ticket_success(data) {

            $(addReferencesTicket.selectorHTML).find('.cod_ref').val("")
            $(addReferencesTicket.selectorHTML).find('.cantidad').val("1"),
                $(addReferencesTicket.selectorHTML).find('.val_uni').val("")
            $(addReferencesTicket.selectorHTML).find(".nom_ref").val("")
            $(addReferencesTicket.selectorHTML).find(".nom_ref").removeClass("is-valid");

            var val_uni_format = new Intl.NumberFormat("es-CL").format(data.val_uni)
            var cantidad_format = new Intl.NumberFormat("es-CL").format(data.cantidad)

            var string_ref = "<tr>"
            string_ref += '<td>' + data.idreg + '</td>'
            string_ref += '<td>' + data.cod_ref + '</td>'
            string_ref += '<td>' + data.product.nom_ref.substring(0, 40) + '</td>'
            string_ref += '<td class="text-right">' + cantidad_format + '</td>'
            string_ref += '<td class="text-right">' + val_uni_format + '</td>'
            string_ref += '<td class="text-center">'
            string_ref += '<a class="btn btn-delete-ref bg-danger" data-ref="' + data.idreg + '">'
            string_ref += '<i class="fas fa-trash"></i>'
            string_ref += '</a></td>'
            string_ref += '</tr>'

            $("#table-refs-ticket-db tbody").append(string_ref);
            $(".success-cod-referencia").hide()
        }
    }

    addReferencesTicket.initTableRef();

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
                        beforeSend: function(xhr) {
                            xhr.setRequestHeader('Authorization', '9c296f109cbfa21632dc522a3aade323');
                        },
                        success: function (data) {
                            if (data.data.length == 0) {
                                tableRefsTicket.change_cod_ref_error(element);
                            } else {
                                tableRefsTicket.change_cod_ref_success(data.data, element);
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
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Authorization', '9c296f109cbfa21632dc522a3aade323');
                },
                success: function (data) {
                    tableRefsTicket.reset_form_data(data.data);
                },
                error: function (xhr, status) {
                    console.log(xhr, status);
                }
            });
        }

        static reset_form_data(data) {
            setTimeout(function () {
                $(".form-create-ticket").find('#nom_mer').removeClass("is-valid");

                $("#table-references-ticket tbody tr").each(function (index, element) {

                    $(element).find('.cod_ref').val("")
                    $(element).find('.nom_ref').val("")
                    $(element).find('.nom_ref').removeClass("is-valid")
                    $(element).find('.cantidad').val("")
                    $(element).find('.val_uni').val("")
                });
            }, 5000);
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

        // URL de item clientes en menu.
        if (arrayDeCadenas.indexOf('sub-page=clientes') == -1) {
            $(".item-menu-clientes a").attr("href", window.location.href.split("?")[0] + "?" + arrayDeCadenas[0] + "&sub-page=clientes");
        }

        // URL de item productos en menu.
        if (arrayDeCadenas.indexOf('sub-page=productos') == -1) {
            $(".item-menu-productos a").attr("href", window.location.href.split("?")[0] + "?" + arrayDeCadenas[0] + "&sub-page=productos");
        }

        // URL de item tickets en menu.
        if (arrayDeCadenas.indexOf('sub-page=tickets') == -1) {
            $(".item-menu-tickets a").attr("href", window.location.href.split("?")[0] + "?" + arrayDeCadenas[0] + "&sub-page=tickets");
        }

        // URL de item notices en menu.
        if (arrayDeCadenas.indexOf('sub-page=notices') == -1) {
            $(".item-menu-notices a").attr("href", window.location.href.split("?")[0] + "?" + arrayDeCadenas[0] + "&sub-page=notices");
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

        // Tablas de datos en cada páginca
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
        } else if (arrayDeCadenas.indexOf('sub-page=productos') != -1) {
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
        } else if (arrayDeCadenas.indexOf('sub-page=page-customer') != -1) {
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
        } else if (arrayDeCadenas.indexOf('sub-page=clientes') != -1) {
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
        } else if (arrayDeCadenas.indexOf('sub-page=tickets') != -1) {
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
        } else {
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

            ticketClass.get_email_user_wp($("#cod_mer").val())
        });

        $("#cod_mer").on("change", function () {
            var cod_mer = $("#cod_mer").val();
            ticketClass.change_cod_mer(cod_mer);
        });

        $("#description").addClass("active");

        $("#tickets").addClass("active");

        $("#btn-table_add_referencia").on("click", function () {
            $("#table_add_referencia").show();
        });

        /**
         * Clase tableReferenciasTicket para tabla de referencias de un
         * ticket.
         */
        class tableReferenciasTicket {
            constructor() { }

            /**
             * Funcion cuando se elimina una referencia de un ticket
             * 
             * @param {id} id 
             */
            static deleteReferenciasTicket(id, element) {
                var element_html = element

                $.ajax({
                    url: ticketClass.url + "ticketRef/" + id,
                    method: 'delete',
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('Authorization', '9c296f109cbfa21632dc522a3aade323');
                    },
                    success: function (data) {
                        tableReferenciasTicket.deleteReferenciasTicket_success(element_html)
                    },
                    error: function (xhr, status) {
                        console.log(xhr, status);
                    }
                });
            }

            /**
             * Function cuando se elimina la referencia de un ticket
             * 
             * @param element_html 
             */
            static deleteReferenciasTicket_success(element_html) {
                $(element_html.parentNode.parentNode).animate({ backgroundColor: "#ff0000" }, 1000, function () {
                    // Después de cambiar el color, desvanecer y eliminar el elemento
                    $(this).fadeOut(1000, function () {
                        $(this).remove(); // Eliminar totalmente el elemento HTML
                    });
                });
            }

            /**
             * Function para agregar comentario a un ticket
             * 
             * @param id 
             * @param element 
             */
            static addCommentTicket(id_ticket, cod_user, title, text_notice) {
                var dataSend = {
                    id_ticket: id_ticket,
                    cod_user: cod_user,
                    title: title,
                    text_notice: text_notice
                }

                $.ajax({
                    url: ticketClass.url + "createNotice",
                    method: 'post',
                    dataType: 'json',
                    data: dataSend,
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('Authorization', '9c296f109cbfa21632dc522a3aade323');
                    },
                    success: function (data) {
                        $('.error-comment-ticket').hide()
                        $('.success-comment-ticket').show()
                        tableReferenciasTicket.addCommentTicket_success(data);
                    },
                    error: function (xhr, status) {
                        $('.success-comment-ticket').hide()
                        $('.error-comment-ticket').show()
                        console.log("Error");
                    }
                });
            }

            /**
             * Function cuando se agrega el comentario
             * 
             * @param data 
             */
            static addCommentTicket_success(data) {
                $('#coment_ticket').val('')
            }
        }

        $(".btn-delete-ref").each(function (index, element) {
            $(element).on("click", function (event) {
                tableReferenciasTicket.deleteReferenciasTicket($(element).data("ref"), element);
            })
        });

        $('#btn-coment_ticket').on('click', function (event, element) {
            var coment_ticket = $('#coment_ticket').val()
            var creator_ticket = $('#btn-coment_ticket').data('creator')
            var id_ticket = $('#btn-coment_ticket').data('ticketid')
            var title_ticket = "ha coemntado el ticket."
            tableReferenciasTicket.addCommentTicket(id_ticket, creator_ticket, title_ticket, coment_ticket)
        })
    }

    if (arrayDeCadenas[0] == "page=mys_crm_hub") {
        
    }
})