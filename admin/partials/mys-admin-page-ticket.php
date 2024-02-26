<?php
try {
    if (isset($_GET["id-ticket"])) {
        $id_ticket = $_GET["id-ticket"];

        $parametros = array(
            'idreg' => $id_ticket
        );

        $ticket = json_decode(CRM_HUB_API::POST("ticket", $parametros), true)["data"];
    };
} catch (Exception $e) {
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
}
?>

<div class="row">

    <!-- Columna de informacion del ticket -->
    <div class="col-md-4">

        <!-- Imagen del producto -->
        <div class="card card-maroon card-outline card-crm-products-left">
            <div class="card-body">
                <h4 class="text-center"><?php echo esc_html($ticket[0]['title_ticket']); ?></h4>
                <div class="text-center mb-2">
                    <?php
                    switch ($ticket[0]['cod_estado']) {
                        case '0':
                            echo '<span class="badge bg-danger">Pendiente</span>';
                            break;
                        case '1':
                            echo '<span class="badge bg-warning">En proceso</span>';
                            break;
                        case '2':
                            echo '<span class="badge bg-success">Listo</span>';
                            break;
                    }
                    ?>
                </div>
                <?php
                echo '<p class="text-center text-muted">';
                $date = new DateTimeImmutable($ticket[0]['fecha_aded']);
                echo $date->format('d-M-Y h:i a');
                echo '</p>';
                ?>
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-3 pt-1">
                                <span class="text-muted">Estado:</span>
                            </div>
                            <div class="col-9">
                                <div class="form-group m-0">
                                    <select class="form-control-sm custom-select rounded-1" width="300px">
                                        <option>Pendiente</option>
                                        <option>En proceso</option>
                                        <option>Listo</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-12 pb-2">
                                <span class="text-muted mb-2">Descripcion:</span>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea class="form-control" rows="5"><?php echo trim($ticket[0]['des_ticket']) ?></textarea>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-12 pb-2">
                                <span class="text-muted">Responsable:</span>
                            </div>
                            <div class="col-3">
                                <?php
                                echo '<input type="text" class="form-control rounded-1" value="';
                                echo esc_attr($ticket[0]['user']['cod_mer']);
                                echo '">';
                                ?>
                            </div>
                            <div class="col-9">
                                <?php
                                echo '<input type="text" class="form-control rounded-1" value="';
                                echo esc_attr($ticket[0]['user']['nom_mer']);
                                echo '" disabled>';
                                ?>
                            </div>
                        </div>
                    </li>
                </ul>
                <a class="btn bg-navy btn-block"><b>Actualizar</b></a>
            </div>
        </div>

    </div>

    <!-- Columna de informacion del ticket -->
    <div class="col-md-8">

        <!-- Columna de informacion -->
        <div class="card card-maroon card-outline card-crm-products-rigth">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#description" data-toggle="tab">Descripcion</a></li>
                    <li class="nav-item"><a class="nav-link" href="#invoices" data-toggle="tab">Saldos</a></li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">

                    <div class="tab-pane" id="description">
                        <!-- Descripcion -->
                        <div class="card-body p-0">
                            <div class="row mb-2">
                                <div class="col-12 pb-2">
                                    <span class="font-weight-bold mb-2">Informacion del cliente</span>
                                </div>
                                <div class="col-3">
                                    <span class="text-muted">Documento:</span>
                                </div>
                                <div class="col-9">
                                    <span><?php echo esc_html(number_format(floatval($ticket[0]['customer']['cod_ter']), 0, ',', '.')) ?></span>
                                </div>
                                <div class="col-3">
                                    <span class="text-muted">Nombre:</span>
                                </div>
                                <div class="col-9">
                                    <span><?php echo esc_html($ticket[0]['customer']['nom_ter']) ?></span>
                                </div>
                                <div class="col-3">
                                    <span class="text-muted">Ciudad:</span>
                                </div>
                                <div class="col-9">
                                    <span><?php echo esc_html($ticket[0]['customer']['ciudad']) ?></span>
                                </div>
                                <div class="col-3">
                                    <span class="text-muted">Direccion:</span>
                                </div>
                                <div class="col-9">
                                    <span><?php echo esc_html($ticket[0]['customer']['dir1']) ?></span>
                                </div>
                                <div class="col-3">
                                    <span class="text-muted">Telefono:</span>
                                </div>
                                <div class="col-9">
                                    <span><?php echo esc_html($ticket[0]['customer']['tel1']) ?></span>
                                </div>
                                <div class="col-3">
                                    <span class="text-muted">Correo:</span>
                                </div>
                                <div class="col-9">
                                    <span><?php echo esc_html($ticket[0]['customer']['email']) ?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="invoices">
                        <!-- Facturas -->
                        <div class="card-body p-0"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>