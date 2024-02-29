<?php
    /**
     * Usuario actual de WordPress
     */
    $current_user = wp_get_current_user();

    /**
     * Vendedor de SIASOFT relacionado
     */
    try {
        $parametros = array(
            'cod_mer' => $current_user->data->cod_siasoft
        );

        $user_sia = json_decode(CRM_HUB_API::POST("user", $parametros), true)["data"][0];
        
    } catch (Exception $e) {
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }
?>

<div class="wrrap">

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">

            <!-- Navbar -->
            <?php require_once 'General/mys-admin-navbar.php'; ?>

            <!-- Main Sidebar Container -->
            <?php require_once 'General/mys-admin-sidebar.php'; ?>

            <!-- Contains page content -->
            <div class="content-wrapper">

                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <?php
                                /**
                                 * Condicional de titulo para cada pagina
                                 */
                                if (isset($_GET["sub-page"]) && $_GET["sub-page"] == 'clientes') {
                                    echo '<h1 class="m-0">Clientes</h1>';
                                };
                                if (isset($_GET["sub-page"]) && $_GET["sub-page"] == 'productos') {
                                    echo '<h1 class="m-0">Productos</h1>';
                                };
                                if (isset($_GET["sub-page"]) && $_GET["sub-page"] == 'tickets') {
                                    echo '<h1 class="m-0">Tickets de clientes</h1>';
                                };
                                if (isset($_GET["sub-page"]) && $_GET["sub-page"] == 'page-product') {
                                    echo '<h1 class="m-0">Detalle de producto</h1>';
                                };
                                if (isset($_GET["sub-page"]) && $_GET["sub-page"] == 'page-ticket') {
                                    echo '<h1 class="m-0">Detalle de ticket</h1>';
                                };
                                if (isset($_GET["sub-page"]) && $_GET["sub-page"] == 'page-customer') {
                                    echo '<h1 class="m-0">Detalle de cliente</h1>';
                                };
                                ?>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <?php
                                    /**
                                     * Breadcrumb de ruta actual
                                     */
                                    echo '<li class="breadcrumb-item"><a href="';
                                    echo get_admin_url() . 'admin.php?page=mys_crm_hub';
                                    echo '">Home</a></li>';

                                    if (isset($_GET["sub-page"]) && $_GET["sub-page"] == 'clientes') {
                                        echo '<li class="breadcrumb-item active">Clientes</li>';
                                    };
                                    if (isset($_GET["sub-page"]) && $_GET["sub-page"] == 'productos') {
                                        echo '<li class="breadcrumb-item active">Productos</li>';
                                    };
                                    if (isset($_GET["sub-page"]) && $_GET["sub-page"] == 'tickets') {
                                        echo '<li class="breadcrumb-item active">Tickets de clientes</li>';
                                    };
                                    if (isset($_GET["sub-page"]) && $_GET["sub-page"] == 'page-product') {
                                        echo '<li class="breadcrumb-item active">Detalle de producto</li>';
                                    };
                                    if (isset($_GET["sub-page"]) && $_GET["sub-page"] == 'page-ticket') {
                                        echo '<li class="breadcrumb-item active">Detalle de ticket</li>';
                                    };
                                    if (isset($_GET["sub-page"]) && $_GET["sub-page"] == 'page-customer') {
                                        echo '<li class="breadcrumb-item active">Detalle de cliente</li>';
                                    };
                                    ?>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">

                        <?php
                        /**
                         * Condicional de vista que se muestra segun los parametros
                         */
                        if (isset($_GET["sub-page"]) && $_GET["sub-page"] == 'clientes') {
                            //Data customers
                            require_once 'Customer/mys-admin-customers.php'; 
                        };
                        if (isset($_GET["sub-page"]) && $_GET["sub-page"] == 'productos') {
                            //Data product list
                            require_once 'Product/mys-admin-products.php';
                        };
                        if (isset($_GET["sub-page"]) && $_GET["sub-page"] == 'tickets') {
                            //Data tickets list
                            require_once 'Ticket/mys-admin-tickets.php';
                        };
                        if (isset($_GET["sub-page"]) && $_GET["sub-page"] == 'page-product') {
                            //Data of a product
                            require_once 'Product/mys-admin-page-product.php';
                        };
                        if (isset($_GET["sub-page"]) && $_GET["sub-page"] == 'page-ticket') {
                            //Data of a product
                            require_once 'Ticket/mys-admin-page-ticket.php';
                        };
                        if (isset($_GET["sub-page"]) && $_GET["sub-page"] == 'page-customer') {
                            //Data of a customer
                            require_once 'Customer/mys-admin-page-customer.php';
                        };
                        ?>

                    </div>
                </section>

            </div>

            <!-- main-footer -->
            <?php require_once 'General/mys-admin-footer.php'; ?>

        </div>
    </body>
</div>