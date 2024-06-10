<?php

/**
 * Vista de formulacio para crear ticket
 */
?>
<div class="modal fade" id="modal-default">
    <div class="modal-dialog form-create-ticket">
        <div class="modal-content">

            <!-- Header modal -->
            <div class="modal-header">
                <h5 class="modal-title">Crear de ticket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Body modal -->
            <div class="modal-body">
                <div class="row">

                    <!-- Formulario de datos basicos de ticket -->
                    <div class="col-4 border-right">

                        <!-- Formulario para crear ticket -->
                        <div class="row">

                            <!-- Tipo de ticket -->
                            <div class="col-3 pt-1 pb-2">
                                <span class="text-muted">Tipo de ticket:</span>
                            </div>
                            <div class="col-9 pb-2">
                                <div class="form-group m-0">
                                    <select name="cod_type" id="cod_type" class="form-control-sm custom-select rounded-1">
                                        <?php
                                        try {
                                            $headers = [
                                                'Authorization: ' . CRM_HUB_MYS_API_TOKEN,
                                            ];
                                            $types = json_decode(CRM_HUB_API::GET("typetickets", $headers), true)["data"];
                                            foreach ($types as $type) {
                                                echo '<option value="';
                                                echo esc_attr($type['idreg']);
                                                echo '">';
                                                echo esc_html($type['name_type']);
                                                echo '</option>';
                                            }
                                        } catch (Exception $e) {
                                            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <!-- Cliente -->
                            <div class="col-3 pt-2">
                                <span class="text-muted">Cliente:</span>
                            </div>
                            <div class="col-5 pb-2">
                                <?php
                                echo '<input name="cod_ter" id="cod_ter" type="text" class="form-control rounded-1" value="';
                                echo esc_attr(trim($customer['cod_ter']));
                                echo '" disabled>';
                                ?>
                            </div>
                            <div class="col-9 pb-2 offset-md-3">
                                <?php
                                echo '<input name="" id="" type="text" class="form-control rounded-1" value="';
                                echo esc_attr($customer['nom_ter']);
                                echo '" disabled>';
                                ?>
                            </div>

                            <!-- Titulo del ticket -->
                            <div class="col-3 pt-2">
                                <span class="text-muted">Titulo:</span>
                            </div>
                            <div class="col-9 pb-2">
                                <textarea name="des_ticket" id="title_ticket" class="form-control" rows="2"></textarea>
                            </div>

                            <!-- Descripcion del ticket -->
                            <div class="col-3 pt-2">
                                <span class="text-muted">Descripcion:</span>
                            </div>
                            <div class="col-9 pb-2">
                                <textarea name="des_ticket" id="des_ticket" class="form-control" rows="4"></textarea>
                            </div>

                            <!-- Responsable -->
                            <div class="col-3 pt-2">
                                <span class="text-muted">Responsable:</span>
                            </div>
                            <div class="col-3 pb-2">
                                <input name="cod_mer" id="cod_mer" type="text" class="form-control rounded-1" value="">
                            </div>
                            <div class="col-9 pb-2 offset-md-3">
                                <input name="nom_mer" id="nom_mer" type="text" class="form-control rounded-1" value="" disabled>
                                <div class="invalid-feedback error-cod-mer ml-2">
                                    El codigo de vendedor no existe.
                                </div>
                                <div class="valid-feedback success-cod-mer ml-2">
                                    El codigo de vendedor es correcto.
                                </div>
                            </div>
                        </div>

                        <!-- Icono de carga -->
                        <div class="onprocess-form">
                            <i class="fas fa-3x fa-sync-alt"></i>
                        </div>

                    </div>

                    <!-- Formulario de referencias de cada ticket -->
                    <div class="col-8 px-2 table-content-referencias">

                        <table class="table table-bordered" id="table-references-ticket">

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

                        <!-- Mensaje de errores -->
                        <div class="invalid-feedback error-table-ref ml-2">
                            Algunas referencias tienen errores.
                        </div>

                        <!-- Icono de carga de formulario -->
                        <div class="onprocess-form">
                            <i class="fas fa-3x fa-sync-alt"></i>
                        </div>

                        <!-- Alertas de errores -->
                        <div class="invalid-feedback error-form-ticket ml-2"></div>
                        <div class="valid-feedback success-form-ticket ml-2"></div>
                    </div>
                </div>
            </div>

            <!-- Footer modal -->
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <div>
                    <span class="text-url-ticket">Click aquí para ver el nuevo Ticket:
                        <b><a href="">Click aquí</a></b>
                    </span>
                </div>

                <button id="create-new-ticket" type="button" class="btn btn-primary" data-creator="<?php echo $user_sia['cod_mer'] ?>" data-email="<?php echo $current_user->data->user_email; ?>">Guardar ticket</button>
            </div>

        </div>
    </div>
</div>