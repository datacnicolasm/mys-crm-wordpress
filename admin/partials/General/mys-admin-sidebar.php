<?php
/**
 * Barra de navegacion lateral
 */
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Brand Logo -->
    <a href="<?php echo get_admin_url() . 'admin.php?page=mys_crm_hub'; ?>" class="brand-link">
        <img src=<?php echo CRM_HUB_MYS_PLUGIN_URL . '/admin/dist/img/logo-mys.jpg' ?> alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">CRM Hub</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src=<?php echo CRM_HUB_MYS_PLUGIN_URL . '/admin/dist/img/user-default.png' ?> class="img-circle elevation-2" alt="User Image" height="160px" width="160px">
            </div>
            <div class="info">
                <a href="<?php echo get_admin_url() . 'admin.php?page=mys_crm_hub'; ?>" class="d-block"><?php echo esc_html($current_user->display_name) ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <?php
                /**
                 * Condicional de menu activo
                 */
                $clientes = "";
                $productos = "";
                $tickets = "";
                $notices = "";
                if (isset($_GET["sub-page"]) && $_GET["sub-page"] == 'clientes') {
                    $clientes = "active";
                };
                if (isset($_GET["sub-page"]) && $_GET["sub-page"] == 'productos') {
                    $productos = "active";
                };
                if (isset($_GET["sub-page"]) && $_GET["sub-page"] == 'page-product') {
                    $productos = "active";
                };
                if (isset($_GET["sub-page"]) && $_GET["sub-page"] == 'page-ticket') {
                    $tickets = "active";
                };
                if (isset($_GET["sub-page"]) && $_GET["sub-page"] == 'tickets') {
                    $tickets = "active";
                };
                if (isset($_GET["sub-page"]) && $_GET["sub-page"] == 'notices') {
                    $notices = "active";
                };
                if (isset($_GET["sub-page"]) && $_GET["sub-page"] == 'page-customer') {
                    $clientes = "active";
                };
                ?>

                <!-- -->
                <li class="nav-item item-menu-clientes">
                    <a href="" class="nav-link <?php echo $clientes ?>">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Clientes
                        </p>
                    </a>
                </li>
                
                <!-- -->
                <li class="nav-item item-menu-productos">
                    <a href="#" class="nav-link <?php echo $productos ?>">
                        <i class="nav-icon fas fa-barcode"></i>
                        <p>
                            Productos
                        </p>
                    </a>
                </li>
                
                <!-- -->
                <li class="nav-item item-menu-tickets">
                    <a href="#" class="nav-link <?php echo $tickets ?>">
                        <i class="nav-icon fas fa-folder"></i>
                        <p>
                            Tickets
                        </p>
                    </a>
                </li>
                
                <!-- -->
                <li class="nav-item item-menu-notices">
                    <a href="#" class="nav-link <?php echo $notices ?>">
                        <i class="nav-icon fas fa-bell"></i>
                        <p>
                            Notificaciones
                        </p>
                    </a>
                </li>

                <!-- -->
                <li class="nav-item">
                    <a href="https://ninth-blue-44e.notion.site/Ayuda-CRM-HUB-de-Motos-Servitecas-ddfcdea9909949d88c9d3eec8ff48a13?pvs=4" class="nav-link" target="_blank">
                        <i class="nav-icon fas fa-question-circle"></i>
                        <p>
                            Ayuda
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>