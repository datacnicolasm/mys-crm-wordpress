<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Brand Logo -->
    <a href="#" class="brand-link">
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
                <a href="#" class="d-block"><?php echo esc_html($current_user->display_name) ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item item-menu-clientes">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Clientes
                        </p>
                    </a>
                </li>
                <li class="nav-item item-menu-productos">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-barcode"></i>
                        <p>
                            Productos
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>