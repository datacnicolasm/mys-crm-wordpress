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
        static save_data_new_ticket() {
            $(".onprocess-form").css("display", "flex");
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
                title_ticket: $("title_ticket").val(),
                des_ticket: $("des_ticket").val(),
                cod_user: $("cod_mer").val(),
                cod_ref: $("cod_ref").val(),
                cod_pipeline: "1",
                cod_estado: "0"
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
                    $("#badge-estado").html('<span class="badge bg-danger">Pendiente</span>');
                    break;
                case '1':
                    $("#badge-estado").html('<span class="badge bg-warning">En proceso</span>');
                    break;
                case '2':
                    $("#badge-estado").html('<span class="badge bg-success">Listo</span>');
                    break;
            }
        };
        static save_data_ticket_error() {
            $(".onprocess-form").css("display", "none");
            $(".success-save-ticket").hide();
            $(".error-save-ticket").show();
        };
    }

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
        $(".form-create-ticket").css("max-width", "600px");
        $(".form-create-ticket").css("margin-top", "4rem");
        $(".form-create-ticket select").css("max-width", "inherit");

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
                ticketClass.save_data_new_ticket();
            }
        });

        $("#cod_mer").on("change", function () {
            var cod_mer = $("#cod_mer").val();
            ticketClass.change_cod_mer(cod_mer);
        });

        $("#description").addClass("active");

        $("#cod_ref").on("change", function () {
            var cod_mer = $("#cod_ref").val();
            ticketClass.change_cod_ref(cod_mer);
        });
    }

})