<?php
/**
 * Vista de listado de productos
 */
?>
<div class="row">
    <div class="col-12">

        <div class="card card-crm-motos card-maroon card-outline">
            <div class="card-header">
                <h3 class="card-title">Listado de referencias de repuestos y accesorios.</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="products-page" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Cod ref</th>
                            <th>Descripcion</th>
                            <th>Precio de venta</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $products = json_decode(CRM_HUB_API::GET("products", $headers), true)["data"];
                        foreach ($products as $product) {
                            echo "<tr>";
                            echo "<td>";
                            echo '<a href="' . get_admin_url() . 'admin.php?page=mys_crm_hub&sub-page=page-product&id-product=' . $product['idrow'] . '" target="_blank">';
                            echo esc_html($product["cod_ref"]);
                            echo '</a>';
                            echo "</td>";
                            echo "<td>" . esc_html($product["nom_ref"]) . "</td>";
                            echo '<td class="text-right">' . esc_html(number_format(floatval($product["val_ref"]), 0, ',', '.')) . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Cod ref</th>
                            <th>Descripcion</th>
                            <th>Precio de venta</th>
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