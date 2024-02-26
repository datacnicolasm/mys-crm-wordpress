jQuery(document).ready(function ($) {

    $.widget.bridge('uibutton', $.ui.button)

    var arrayDeCadenas = window.location.href.split("?")[1].split("&");

    if (arrayDeCadenas[0] == "page=mys_crm_hub") {
        $(".update-nag").css("display", "none");
        $("#adminmenumain").css("display", "none");
        $("#wpcontent").css("margin-left", "0");
        $("#wpcontent").css("padding-left", "0");
        $("#wpbody-content").css("padding-bottom", "0");
        $("#wpfooter").css("display", "none");

        console.log(arrayDeCadenas.length);

        console.log(arrayDeCadenas);

        if (arrayDeCadenas.indexOf('sub-page=clientes') == -1) {
            $(".item-menu-clientes a").attr("href", window.location.href.split("?")[0] + "?" + arrayDeCadenas[0] + "&sub-page=clientes");
        }

        if (arrayDeCadenas.indexOf('sub-page=productos') == -1) {
            $(".item-menu-productos a").attr("href", window.location.href.split("?")[0] + "?" + arrayDeCadenas[0] + "&sub-page=productos");
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
    }

    // TABLES

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

    // Click para guardar información de ticket

    class apiClass {
        constructor() {
        }

        static url = "http://localhost/my-api/public/";

        static post_api_crm(url, data) {

        }
    };


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
        static save_data_ticket_success(data) {
            $(".onprocess-form").css("display", "none");
            $(".error-save-ticket").hide();
            $(".success-save-ticket").show();
            
            switch (data.cod_estado) {
                case '0':
                    $("#badge-estado").html('<span class="badge bg-danger">Pendiente</span>');
                    break;
                case '1':
                    $("#badge-estado").html('<span class="badge bg-warning">En proceso</span>');
                    break;
                case '2':
                    $("#badge-estado").html('<span class="badge bg-success">Listo</span>');
                    break;
            }
        }
        static save_data_ticket_error() {
            $(".onprocess-form").css("display", "none");
            $(".success-save-ticket").hide();
            $(".error-save-ticket").show();
        }
    }

    $("#save-data-ticket").on("click", function (e) {
        e.preventDefault();

        var validate = ticketClass.validate_data_ticket();
        if (validate) {
            ticketClass.save_data_ticket()
        }
    });

    $("#cod_mer").on("change", function () {
        var cod_mer = $("#cod_mer").val();
        ticketClass.change_cod_mer(cod_mer);
    });

})