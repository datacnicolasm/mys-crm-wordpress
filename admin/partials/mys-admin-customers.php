<?php
try {
    $customers = json_decode(CRM_HUB_API::GET("customers"), true)["data"];
} catch (Exception $e) {
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
}
?>

<div class="row">
    <div class="col-12">

        <div class="card card-crm-motos card-maroon card-outline">
            <div class="card-header">
                <h3 class="card-title">Listado de clientes.</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="customer-page" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Identidad</th>
                            <th>Nombre</th>
                            <th>Telefono</th>
                            <th>Email</th>
                            <th>Ciudad</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($customers as $customer) {
                            echo '<tr>';
                            
                            echo '<td>';
                            echo '<a href="' . get_admin_url() . 'admin.php?page=mys_crm_hub&sub-page=page-customer&id-customer=' . $customer['idrow'] . '" target="_blank">';
                            echo esc_html($customer['cod_ter']);
                            echo '</a>';
                            echo '</td>';

                            echo '<td>';
                            echo esc_html($customer['nom_ter']);
                            echo '</td>';

                            echo '<td>';
                            echo esc_html($customer['tel1']);
                            echo '</td>';

                            echo '<td>';
                            echo esc_html($customer['email']);
                            echo '</td>';

                            echo '<td>';
                            echo esc_html($customer['ciudad']);
                            echo '</td>';
                            
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Identidad</th>
                            <th>Nombre</th>
                            <th>Telefono</th>
                            <th>Email</th>
                            <th>Ciudad</th>
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