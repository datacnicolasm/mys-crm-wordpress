<?php
/**
 * Vista de pagina especifica de un cliente
 */
try {
    if (isset($_GET["id-customer"])) {
        $id_customer = $_GET["id-customer"];

        $parametros = array(
            'idrow' => $id_customer
        );

        $customer = json_decode(CRM_HUB_API::POST("customer", $parametros), true)["data"][0];
    };
} catch (Exception $e) {
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
}
?>

<div class="row">

    <!-- Columna de informacion del ticket -->
    <div class="col-md-4">

        <div class="card card-widget widget-customer p-0">

            <div class="widget-customer-header bg-navy">
                <h3 class="widget-customer-username"><?php echo esc_html($customer['nom_ter']) ?></h3>
            </div>
            <div class="widget-customer-image">
                <img class="img-circle elevation-2" src="<?php echo CRM_HUB_MYS_PLUGIN_URL . '/admin/dist/img/user-default.png' ?>" alt="User Avatar" height="128px" width="128px">
            </div>
            <div class="card-footer">
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <span><i class="fas fa-hashtag mx-1"></i>
                            <?php echo esc_html(number_format(floatval($customer['cod_ter']), 0, ',', '.')) ?>
                        </span>
                    </li>
                    <li class="list-group-item">
                        <span><i class="fas fa-phone mx-1"></i>
                            <?php echo esc_html($customer['tel1']) ?>
                        </span>
                    </li>
                    <li class="list-group-item">
                        <span><i class="fas fa-house-user mx-1"></i>
                            <?php echo esc_html($customer['dir']) ?>
                        </span>
                    </li>
                    <li class="list-group-item">
                        <span><i class="fas fa-map-marker-alt mx-2"></i>
                            <?php echo esc_html($customer['ciudad']) ?>
                        </span>
                    </li>
                    <li class="list-group-item">
                        <span><i class="fas fa-at mx-2"></i>
                            <?php echo esc_html($customer['email']) ?>
                        </span>
                    </li>
                </ul>
                <button data-idrow="<?php echo esc_attr($customer['idrow']); ?>" id="create-customer-ticket" class="btn bg-navy btn-block" type="submit" data-toggle="modal" data-target="#modal-default">Crear ticket</button>
            </div>
        </div>

        <?php require_once CRM_HUB_MYS_DIR . 'admin/partials/Ticket/mys-admin-ticket-form.php'; ?>
    </div>

    <!-- Columna de informacion del ticket -->
    <div class="col-md-8">

        <div class="card card-navy card-outline card-crm-products-rigth">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h2>150</h2>
                                <p>Ordenes de servicio</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-document"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h2>53</h2>
                                <p>Facturas</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-document-text"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h2>$650.000</h2>
                                <p>Ticket</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Columna de informacion -->
        <div class="card card-navy card-outline card-crm-products-rigth">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#tickets" data-toggle="tab">Tickets</a></li>
                    <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Motocicletas</a></li>
                    <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Facturas</a></li>
                    <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Ordenes</a></li>
                    <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Data</a></li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">

                    <div class="tab-pane" id="tickets">
                        <!-- Descripcion -->
                        <div class="card-body p-0">
                            <table id="tickets-product" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 20px">ID</th>
                                        <th class="text-center">Fecha</th>
                                        <th class="text-center">Tipo de ticket</th>
                                        <th class="text-center">Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $tickets = $customer['tickets'];
                                    foreach ($tickets as $ticket) {
                                        echo "<tr>";

                                        echo '<td>' . esc_html($ticket['idreg']) . '</td>';

                                        echo '<td>';
                                        $date = new DateTimeImmutable($ticket['fecha_aded']);
                                        echo $date->format('d-m-Y h:i');
                                        echo '</td>';

                                        echo '<td>';
                                        echo '<a href="';
                                        echo get_admin_url();
                                        echo 'admin.php?page=mys_crm_hub&sub-page=page-ticket&id-ticket=' . $ticket['idreg'];
                                        echo '" target="_blank">';
                                        echo esc_html($ticket['type']['name_type']);
                                        echo '</a>';
                                        echo '</td>';

                                        switch ($ticket['cod_estado']) {
                                            case '0':
                                                echo '<td>';
                                                echo '<span class="badge bg-info">Pendiente</span>';
                                                echo '</td>';
                                                break;
                                            case '1':
                                                echo '<td>';
                                                echo '<span class="badge bg-warning">En proceso</span>';
                                                echo '</td>';
                                                break;
                                            case '2':
                                                echo '<td>';
                                                echo '<span class="badge bg-success">vendido</span>';
                                                echo '</td>';
                                                break;
                                            case '3':
                                                echo '<td>';
                                                echo '<span class="badge bg-danger">Venta perdidá</span>';
                                                echo '</td>';
                                                break;
                                        }
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="text-center" style="width: 20px">ID</th>
                                        <th class="text-center">Fecha</th>
                                        <th class="text-center">Tipo de ticket</th>
                                        <th class="text-center">Estado</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane" id="timeline">
                        <!-- Facturas -->
                        <div class="card-body p-0"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>