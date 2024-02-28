<?php
    $current_user = wp_get_current_user();

    try {
        $parametros = array(
            'cod_mer' => $current_user->data->cod_siasoft
        );

        $user_sia = json_decode(CRM_HUB_API::POST("user", $parametros), true)["data"][0];
        
    } catch (Exception $e) {
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }

    //echo "<pre>";
    //var_dump($user_sia);
    //echo "</pre>";
?>

<div class="wrrap">

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">

            <!-- Navbar -->
            <?php require_once 'mys-admin-navbar.php'; ?>

            <!-- Main Sidebar Container -->
            <?php require_once 'mys-admin-sidebar.php'; ?>

            <!-- Contains page content -->
            <div class="content-wrapper">

                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <?php
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
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <?php
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
                        if (isset($_GET["sub-page"]) && $_GET["sub-page"] == 'clientes') {
                            //Data customers
                            require_once 'mys-admin-customers.php'; 
                        };
                        if (isset($_GET["sub-page"]) && $_GET["sub-page"] == 'productos') {
                            //Data product list
                            require_once 'mys-admin-products.php';
                        };
                        if (isset($_GET["sub-page"]) && $_GET["sub-page"] == 'tickets') {
                            //Data tickets list
                            require_once 'mys-admin-tickets.php';
                        };
                        if (isset($_GET["sub-page"]) && $_GET["sub-page"] == 'page-product') {
                            //Data of a product
                            require_once 'mys-admin-page-product.php';
                        };
                        if (isset($_GET["sub-page"]) && $_GET["sub-page"] == 'page-ticket') {
                            //Data of a product
                            require_once 'mys-admin-page-ticket.php';
                        };
                        if (isset($_GET["sub-page"]) && $_GET["sub-page"] == 'page-customer') {
                            //Data of a customer
                            require_once 'mys-admin-page-customer.php';
                        };
                        ?>

                    </div>
                </section>

            </div>

            <!-- main-footer -->
            <?php require_once 'mys-admin-footer.php'; ?>

        </div>
    </body>
</div>