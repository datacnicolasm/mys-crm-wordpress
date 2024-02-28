<?php
try {
    $tickets = json_decode(CRM_HUB_API::GET("tickets"), true)["data"];
} catch (Exception $e) {
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
}
?>

<div class="row">
    <div class="col-12">

        <div class="card card-crm-motos card-maroon card-outline">
            <div class="card-header">
                <h3 class="card-title">Listado de tickets.</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="ticket-page" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fecha</th>
                            <th>Tipo de ticket</th>
                            <th>Referencia</th>
                            <th>Responsable</th>
                            <th>Doc cliente</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
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

                            echo '<td>';
                            echo esc_html($ticket['cod_ref']);
                            echo '</td>';

                            echo '<td>';
                            echo esc_html($ticket['cod_user']);
                            echo '</td>';

                            echo '<td>';
                            echo esc_html($ticket['cod_ter']);
                            echo '</td>';

                            switch ($ticket['cod_estado']){
                                case '0':
                                    echo '<td>';
                                    echo '<span class="badge bg-danger">Pendiente</span>';
                                    echo '</td>';
                                    break;
                                case '1':
                                    echo '<td>';
                                    echo '<span class="badge bg-warning">En proceso</span>';
                                    echo '</td>';
                                    break;
                                case '2':
                                    echo '<td>';
                                    echo '<span class="badge bg-success">Listo</span>';
                                    echo '</td>';
                                    break;
                            }

                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Fecha</th>
                            <th>Tipo de ticket</th>
                            <th>Referencia</th>
                            <th>Responsable</th>
                            <th>Doc cliente</th>
                            <th>Estado</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>