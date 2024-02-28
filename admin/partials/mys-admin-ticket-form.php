<div class="modal fade" id="modal-default">
    <div class="modal-dialog form-create-ticket">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crear de ticket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-4 border-right">
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
                                            $types = json_decode(CRM_HUB_API::GET("typetickets"), true)["data"];
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
                            <div class="col-3 pb-2">
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
                        <div class="onprocess-form">
                            <i class="fas fa-3x fa-sync-alt"></i>
                        </div>
                        <div class="alert alert-success mb-0 mt-1 alert-success">
                            <h5><i class="icon fas fa-check"></i>Información guardada</h5>
                            El ticket ha sido creado, puedes verlo en el listado de tickets del cliente.
                        </div>
                        <div class="alert alert-warning mb-0 mt-1 alert-error">
                            <h5><i class="icon fas fa-exclamation-triangle"></i>Error</h5>
                            Se ha presentado un error.
                        </div>
                    </div>
                    <div class="col-8 px-2 table-content-referencias">
                        <table class="table table-bordered" id="table-references-ticket">
                            <thead>
                                <tr>
                                    <th style="width: 20%" class="text-center">Cod. ref</th>
                                    <th style="width: 45%" class="text-center">Referencia</th>
                                    <th style="width: 15%" class="text-center">Cantidad</th>
                                    <th style="width: 20%" class="text-center">Valor</th>
                                </tr>
                            </thead>
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
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button id="create-new-ticket" type="button" class="btn btn-primary">Guardar ticket</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>