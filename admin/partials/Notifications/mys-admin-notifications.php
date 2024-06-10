<?php

$headers = [
    'Authorization: ' . CRM_HUB_MYS_API_TOKEN,
];

// Notificaciones
$parametros = array(
    'cod_mer' => $current_user->data->cod_siasoft
);

$notices = json_decode(CRM_HUB_API::POST("userNotices", $parametros, $headers), true)["data"];

// Verificacion de existencias
$parametros_refs = array(
    'cod_mer' => $current_user->data->cod_siasoft
);

$notices_referencias = json_decode(CRM_HUB_API::POST("userTicketsReferencias", $parametros_refs, $headers), true)["data"];
?>

<!-- Tabla de notificaciones -->
<div class="row">
    <div class="col-12">

        <div class="card card-crm-motos card-maroon card-outline">

            <div class="card-body">

                <!-- Verificaciones de existencias -->
                <div class="container mb-3">
                    <h5 class="mb-4">Verificacion de referencias <strong>(<?php echo count($notices_referencias) ?>)</strong> </h5>
                    <div class="list-group">

                        <?php

                        if (count($notices_referencias) > 0) {
                            foreach ($notices_referencias as $key => $notice_ref) {

                                $date = new DateTimeImmutable();

                                ?>
                                <a href="<?php echo get_admin_url() . 'admin.php?page=mys_crm_hub&sub-page=page-ticket&id-ticket=' .  $notice_ref['idreg_ticket'] ?>" class="notification list-group-item">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">Ya existen unidades para vender al cliente</h5>
                                        <small class="text-muted"><?php echo $date->format('d M. Y') ?></small>
                                    </div>
                                    <p class="mb-1"><?php echo 'Ya hay unidades de la ref. <strong>' . trim($notice_ref['cod_ref']) . '</strong> para el ticket número ' . $notice_ref['idreg_ticket'] . '.' ?></p>
                                </a>
                                <?php
                            }
                        } else {
                            echo '<span class="text-sm">No tienes notificaciones</span>';
                        }
                        ?>

                    </div>
                </div>

                <div class="dropdown-divider"></div>

                <!-- Verificaciones de existencias -->
                <div class="container mb-3">
                    <h5 class="mb-4">Eventos de tickets <strong>(<?php echo count($notices) ?>)</strong></h5>
                    <div class="list-group">

                        <?php

                        if (count($notices) > 0) {

                            foreach ($notices as $key => $notice) {
                                $date = new DateTimeImmutable($notice['created_at']);

                        ?>
                                <a href="<?php echo get_admin_url() . 'admin.php?page=mys_crm_hub&sub-page=page-ticket&id-ticket=' .  $notice['id_ticket'] ?>" class="notification list-group-item">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1"><?php echo 'Un usuario' . $notice['title'] ?></h5>
                                        <small class="text-muted"><?php echo $date->format('d M. Y') ?></small>
                                    </div>
                                    <p class="mb-1"><?php echo $notice['text_notice'] . ' Ticket número ' . $notice['id_ticket']?></p>
                                </a>
                            <?php
                            }
                        } else {
                            echo '<span class="text-sm">No tienes notificaciones</span>';
                        }
                        ?>



                    </div>
                </div>

            </div>

        </div>

    </div>
</div>