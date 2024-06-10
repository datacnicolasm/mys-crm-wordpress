<?php

/**
 * Vista de menu de navegacion
 */
$parametros = array(
    'cod_mer' => $current_user->data->cod_siasoft
);

$headers = [
    'Authorization: ' . CRM_HUB_MYS_API_TOKEN,
];

$notices = json_decode(CRM_HUB_API::POST("userNotices", $parametros, $headers), true)["data"];
?>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <?php
            echo '<a href="' . get_admin_url() . 'admin.php?page=mys_crm_hub" class="nav-link">Inicio</a>';
            ?>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <?php
                require_once 'mys-admin-cron.php';
                if(count($notices)+count($notices_referencias) > 0)
                {
                    ?>
                    <span class="badge badge-warning navbar-badge"><?php echo count($notices)+count($notices_referencias) ?></span>
                    <?php
                }
                ?>
            </a>
            <div class="dropdown-menu dropdown-menu-crm dropdown-menu-right">
                <span class="dropdown-item dropdown-header mt-2"><?php echo count($notices)+count($notices_referencias) ?> Notificaciones</span>
                <div class="dropdown-divider"></div>
                <?php
                if (count($notices_referencias) > 0) {
                    $count_ref_notices = (count($notices_referencias) >= 4) ? 3 : count($notices_referencias)-1;
                    for ($i = 0; $i <= $count_ref_notices; $i++) {

                        $date = new DateTimeImmutable();

                ?>
                        <a href="<?php echo get_admin_url() . 'admin.php?page=mys_crm_hub&sub-page=page-ticket&id-ticket=' .  $notices_referencias[$i]['idreg_ticket'] ?>" class="dropdown-item">
                            <i class="fas fa-bell mr-2"></i>
                            <span class="title-notice text-sm"><?php echo '[#' . $notices_referencias[$i]['idreg_ticket'] . '] Ya hay unidades de la ref. <strong>' . trim($notices_referencias[$i]['cod_ref']) . '</strong>.'?></span>
                            <span class="float-right time-notice text-muted text-sm"><?php echo $date->format('d M. Y') ?></span>
                        </a>
                        <div class="dropdown-divider"></div>
                    <?php
                    }
                }
                
                if (count($notices) > 0) {
                    $count_notices = (count($notices) >= 4) ? 3 : count($notices)-1;
                    for ($i = 0; $i <= $count_notices; $i++) {
                        $date = new DateTimeImmutable($notices[$i]['created_at']);
                        ?>
                        <a href="<?php echo get_admin_url() . 'admin.php?page=mys_crm_hub&sub-page=page-ticket&id-ticket=' .  $notices[$i]['id_ticket'] ?>" class="dropdown-item">
                            <i class="fas fa-bell mr-2"></i>
                            <span class="title-notice text-sm"><?php echo '[#' . $notices[$i]['id_ticket'] . '] Un usuario ' . $notices[$i]['title'] ?></span>
                            <span class="float-right time-notice text-muted text-sm"><?php echo $date->format('d M. Y') ?></span>
                        </a>
                        <div class="dropdown-divider"></div>
                    <?php
                    }
                } else {
                    ?>
                    <a href="#" class="dropdown-item">
                        <span class="title-notice text-sm">No tienes notificaciones</span>
                    </a>
                    <div class="dropdown-divider"></div>
                <?php
                }
                ?>
                <a href="<?php echo get_admin_url() . 'admin.php?page=mys_crm_hub&sub-page=notices' ?>" class="dropdown-item dropdown-footer mb-2">Ver todas las notificaciones</a>
            </div>
        </li>

    </ul>
</nav>
<!-- /.navbar -->