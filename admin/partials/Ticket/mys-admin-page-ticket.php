<?php

/**
 * Vista de un ticket especifico
 */
try {
    if (isset($_GET["id-ticket"])) {
        $id_ticket = $_GET["id-ticket"];

        $parametros = array(
            'idreg' => $id_ticket
        );

        $headers = [
            'Authorization: ' . CRM_HUB_MYS_API_TOKEN,
        ];

        $ticket = json_decode(CRM_HUB_API::POST("ticket", $parametros, $headers), true)["data"];

    };
} catch (Exception $e) {
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
}
?>

<div class="row">

    <!-- Columna de informacion del ticket -->
    <div class="col-md-4">

        <!-- Informacion basica del ticket -->
        <div class="card card-maroon card-outline card-crm-products-left">
            <div class="card-body" id="card-ticket-form">
                <h4 class="text-center"><?php echo esc_html($ticket[0]['title_ticket']); ?></h4>
                <?php
                echo '<p class="text-center mb-1">';
                echo esc_html($ticket[0]['type']['name_type']);
                echo '</p>';
                ?>
                <div class="text-center mb-2" id="badge-estado">
                    <?php
                    switch ($ticket[0]['cod_estado']) {
                        case '0':
                            echo '<span class="badge bg-info">Pendiente</span>';
                            break;
                        case '1':
                            echo '<span class="badge bg-warning">En proceso</span>';
                            break;
                        case '2':
                            echo '<span class="badge bg-success">Vendido</span>';
                            break;
                        case '3':
                            echo '<span class="badge bg-danger">Venta perdidá</span>';
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
                                    <select name="cod_estado" id="cod_estado" class="form-control-sm custom-select rounded-1" width="300px">
                                        <?php
                                        switch ($ticket[0]['cod_estado']) {
                                            case '0':
                                                echo '<option value="0" selected>Pendiente</option>';
                                                echo '<option value="1">En proceso</option>';
                                                echo '<option value="2">Vendido</option>';
                                                echo '<option value="3">Venta perdidá</option>';
                                                break;
                                            case '1':
                                                echo '<option value="0">Pendiente</option>';
                                                echo '<option value="1" selected>En proceso</option>';
                                                echo '<option value="2">Vendido</option>';
                                                echo '<option value="3">Venta perdidá</option>';
                                                break;
                                            case '2':
                                                echo '<option value="0">Pendiente</option>';
                                                echo '<option value="1">En proceso</option>';
                                                echo '<option value="2" selected>Vendido</option>';
                                                echo '<option value="3">Venta perdidá</option>';
                                                break;
                                            case '3':
                                                echo '<option value="0">Pendiente</option>';
                                                echo '<option value="1">En proceso</option>';
                                                echo '<option value="2">Vendido</option>';
                                                echo '<option value="3" selected>Venta perdidá</option>';
                                                break;
                                        }
                                        ?>
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
                                    <textarea name="des_ticket" id="des_ticket" class="form-control" rows="5"><?php echo trim($ticket[0]['des_ticket']) ?></textarea>
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
                                echo '<input name="cod_mer" id="cod_mer" type="text" class="form-control rounded-1" value="';
                                echo esc_attr($ticket[0]['user']['cod_mer']);
                                echo '">';
                                ?>
                            </div>
                            <div class="col-9">
                                <?php
                                echo '<input name="nom_mer" id="nom_mer" type="text" class="form-control rounded-1" value="';
                                echo esc_attr($ticket[0]['user']['nom_mer']);
                                echo '" disabled>';
                                ?>
                            </div>
                            <div class="invalid-feedback error-cod-mer ml-2">
                                El codigo de vendedor no existe.
                            </div>
                            <div class="valid-feedback success-cod-mer ml-2">
                                El codigo de vendedor es correcto.
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-12 pb-2">
                                <span class="text-muted">Creado por:</span>
                            </div>
                            <div class="col-3">
                                <?php
                                echo '<input name="cod_creator" id="cod_creator" type="text" class="form-control rounded-1" value="';
                                echo esc_attr($ticket[0]['creator']['cod_mer']);
                                echo '" disabled>';
                                ?>
                            </div>
                            <div class="col-9">
                                <?php
                                echo '<input name="nom_creator" id="nom_creator" type="text" class="form-control rounded-1" value="';
                                echo esc_attr($ticket[0]['creator']['nom_mer']);
                                echo '" disabled>';
                                ?>
                            </div>
                            <div class="invalid-feedback error-cod-mer ml-2">
                                El codigo de vendedor no existe.
                            </div>
                            <div class="valid-feedback success-cod-mer ml-2">
                                El codigo de vendedor es correcto.
                            </div>
                        </div>
                    </li>
                    <div class="onprocess-form">
                        <i class="fas fa-3x fa-sync-alt"></i>
                    </div>
                </ul>
                <button data-idreg="<?php echo esc_attr($ticket[0]['idreg']); ?>" id="save-data-ticket" class="btn bg-navy btn-block" type="submit"><b>Actualizar</b></button>
                <div class="valid-feedback success-save-ticket ml-2">
                    El ticket se ha actualizado.
                </div>
                <div class="invalid-feedback error-save-ticket ml-2">
                    El ticket <b>NO</b> se ha actualizado.
                </div>
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
                    <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">

                    <div class="tab-pane" id="description">
                        <!-- Descripcion -->
                        <div class="card-body p-0">

                            <!-- Informacion del cliente -->
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

                            <!-- Listado de referencias del ticket -->
                            <div class="row my-3">
                                <div class="col-12 pb-3">
                                    <span class="font-weight-bold mb-2">Referencias del Ticket</span>
                                </div>

                                <div class="col-12">
                                    <table class="table table-bordered" id="table-refs-ticket-db">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Cod Ref</th>
                                                <th>Referencia</th>
                                                <th class="text-center">Cantidad</th>
                                                <th class="text-center">Valor</th>
                                                <th class="text-center">Editar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $referencias = $ticket[0]["references"];
                                            foreach ($referencias as $refs) {

                                                echo "<tr>";
                                                echo "<td>" . $refs["idreg"] . "</td>";
                                                echo "<td>" . $refs["cod_ref"] . "</td>";
                                                echo "<td>" . substr($refs["product"]["nom_ref"], 0, 40) . "</td>";
                                                echo '<td class="text-right">' . intval($refs["cantidad"]) . "</td>";
                                                echo '<td class="text-right">' . number_format(intval($refs["val_uni"]), 0, '.', ',') . "</td>";
                                                echo '<td class="text-center">';
                                                echo '<a class="btn btn-delete-ref bg-danger" data-ref="' . $refs["idreg"] . '">';
                                                echo '<i class="fas fa-trash"></i>';
                                                echo '</a>';
                                                echo '</td>';
                                                echo "</tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-12 pb-3">
                                    <button type="button" class="btn bg-gradient-primary" id="btn-table_add_referencia">Agregar referencia</button>
                                    <div class="row mt-2">
                                        <div class="col-12">
                                            <table class="table table-bordered" id="table_add_referencia" data-ticket="<?php echo $id_ticket; ?>">

                                                <!-- Head table -->
                                                <thead>
                                                    <tr>
                                                        <th style="width: 20%" class="text-center">Cod. ref</th>
                                                        <th style="width: 45%" class="text-center">Referencia</th>
                                                        <th style="width: 15%" class="text-center">Cantidad</th>
                                                        <th style="width: 20%" class="text-center">Valor</th>
                                                    </tr>
                                                </thead>

                                                <!-- Body table -->
                                                <tbody>
                                                    <tr class="row-form row-1">
                                                        <td>
                                                            <input type="text" class="form-control rounded-1 text-left cod_ref" value="">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control rounded-1 text-left nom_ref" value="" disabled>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control rounded-1 text-center cantidad" value="1">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control rounded-1 text-right val_uni" value="0">
                                                        </td>
                                                    </tr>
                                                </tbody>

                                            </table>

                                            <div class="invalid-feedback error-cod-referencia ml-2">
                                                El codigo de referencia no existe.
                                            </div>
                                            <div class="valid-feedback success-cod-referencia ml-2">
                                                El codigo de referencia si existe <br>
                                                Presione <strong>Enter</strong> en el espacio de "Valor" para agregar la referencia
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Agregar comentarios -->
                            <div class="row mb-2">
                                <div class="col-12 pb-2">
                                    <span class="font-weight-bold mb-2">Agregar comentarios</span>
                                </div>
                                <div class="col-12 pb-2">
                                    <div class="form-group">
                                        <textarea name="coment_ticket" id="coment_ticket" class="form-control" rows="5"></textarea>
                                    </div>
                                    <button type="button" class="btn bg-gradient-primary" id="btn-coment_ticket" data-creator="<?php echo $user_sia['cod_mer'] ?>" data-ticketID="<?php echo $id_ticket; ?>">Agregar comentario</button>
                                    <div class="invalid-feedback error-comment-ticket ml-2">
                                        No se ha agregado el comentario.
                                    </div>
                                    <div class="valid-feedback success-comment-ticket ml-2">
                                        Se ha agregado el comentario.
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="tab-pane" id="timeline">
                        <?php

                        ?>

                        <!-- The timeline -->
                        <div class="timeline timeline-inverse">

                            <?php

                            $notices = $ticket[0]["notices"];

                            for ($i = 0; $i < count($notices); $i++) {
                                
                                $created = new DateTimeImmutable($notices[$i]["created_at"]);

                            ?>
                                <!-- timeline time label -->
                                <div class="time-label">
                                    <span class="bg-danger px-3">
                                        <?php echo $created->format('d M. Y'); ?>
                                    </span>
                                </div>
                                <!-- /.timeline-label -->

                                <!-- timeline item -->
                                <div>
                                    <i class="fas fa-bell bg-primary"></i>

                                    <div class="timeline-item">
                                        <span class="time"><i class="far fa-clock"></i> <?php echo $created->format('h:i a'); ?></span>

                                        <h3 class="timeline-header">
                                            <a href="#">
                                                <?php echo $notices[$i]["user"]["cod_mer"] . "- " . $notices[$i]["user"]["nom_mer"] ?>
                                            </a>
                                            <?php echo " " . $notices[$i]["title"]; ?>
                                        </h3>

                                        <div class="timeline-body">
                                            <?php echo $notices[$i]["text_notice"]; ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- END timeline item -->
                            <?php
                            }

                            ?>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>