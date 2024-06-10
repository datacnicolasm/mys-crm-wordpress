<?php

/**
 * Vista de un producto especifico
 */
try {
    if (isset($_GET["id-product"])) {
        $id_product = $_GET["id-product"];

        $parametros = array(
            'idrow' => $id_product
        );

        $headers = [
            'Authorization: ' . CRM_HUB_MYS_API_TOKEN,
        ];

        $products = json_decode(CRM_HUB_API::POST("product", $parametros, $headers), true)["data"];
    };
} catch (Exception $e) {
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
}

$reg_ecommerce = false;

if (wc_get_product_id_by_sku($products["cod_ref"]) == 0) {
    $reg_ecommerce = false;
} else {
    $reg_ecommerce = true;
    $product_wc = wc_get_product(wc_get_product_id_by_sku($products["cod_ref"]));
}
?>
<div class="row">
    <!-- Columna de informacion del producto -->
    <div class="col-md-8">

        <!-- Columna de informacion -->
        <div class="card card-maroon card-outline card-crm-products-rigth">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#tickets" data-toggle="tab">Tickets</a></li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="active tab-pane" id="tickets">
                        <!-- Ticket -->
                        <div class="card-body p-0">
                            <?php
                            try {

                                $sku_product = $products["cod_ref"];
                                $parametros = array(
                                    'sku' => $sku_product
                                );

                                $tickets = json_decode(CRM_HUB_API::POST("tickesProduct", $parametros, $headers), true)["data"];

                            } catch (Exception $e) {
                                echo 'Excepción capturada: ',  $e->getMessage(), "\n";
                            }
                            ?>
                            <table id="tickets-product" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 20px">ID</th>
                                        <th class="text-center">Fecha</th>
                                        <th class="text-center">Tipo de ticket</th>
                                        <th class="text-center">Cliente</th>
                                        <th class="text-center">Estado</th>
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
                                        echo esc_html($ticket['customer']['nom_ter']);
                                        echo '</td>';

                                        switch ($ticket['cod_estado']) {
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
                                        <th class="text-center" style="width: 20px">ID</th>
                                        <th class="text-center">Fecha</th>
                                        <th class="text-center">Tipo de ticket</th>
                                        <th class="text-center">Cliente</th>
                                        <th class="text-center">Estado</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Columna de informacion del producto -->
    <div class="col-md-4">

        <!-- Imagen del producto -->
        <div class="card card-maroon card-outline card-crm-products-left">
            <div class="card-body">
                <div class="text-center">
                    <?php
                    if ($reg_ecommerce && wp_get_attachment_image_url($product_wc->get_image_id())) {
                        echo '<img class="product-img img-fluid my-1" src="';
                        echo wp_get_attachment_image_url($product_wc->get_image_id());
                        echo '" width="200px" height="200px">';
                    } else {
                        echo '<img class="product-img img-fluid my-1" src="';
                        echo wc_placeholder_img_src();
                        echo '" width="200px" height="200px">';
                    }

                    ?>
                </div>
                <h4 class="profile-username text-center"><?php echo esc_html($products["nom_ref"]) ?></h4>
                <p class="text-muted text-center"><?php echo "Cod. " . esc_html($products["cod_ref"]) ?></p>

                <?php

                $reg_ecommerce = false;

                if (wc_get_product_id_by_sku($products["cod_ref"]) == 0) {
                    echo '<div class="text-center alert-crm">';
                    echo '<span class="badge bg-warning">Sin registro en E-commerce</span>';
                    echo '</div>';
                } else {
                    $reg_ecommerce = true;
                    $product_wc = wc_get_product(wc_get_product_id_by_sku($products["cod_ref"]));
                    echo '<div class="text-center alert-crm">';
                    echo '<span class="badge bg-success">Registrado en e-commerce</span>';
                    echo '</div>';
                }

                ?>

                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Marca:</b> <span class="float-right"><?php echo esc_html($products["brand"]["Nom_mar"]) ?></span>
                    </li>
                    <li class="list-group-item">
                        <b>Linea:</b> <span class="float-right"><?php echo esc_html($products["type"]["nom_tip"]) ?></span>
                    </li>
                    <li class="list-group-item">
                        <b>Grupo:</b> <span class="float-right"><?php echo esc_html($products["group"]["nom_gru"]) ?></span>
                    </li>
                    <li class="list-group-item">
                        <b>Precio de venta:</b> <span class="float-right">
                            <?php echo esc_html(number_format(floatval($products["val_ref"]), 0, ',', '.')) ?>
                        </span>
                    </li>
                    <li class="list-group-item">
                        <b>Descuento:</b> <span class="float-right">
                            <?php
                            if ($reg_ecommerce) {
                                echo esc_html(number_format(floatval($product_wc->get_sale_price()), 0, ',', '.'));
                            } else {
                                echo "-";
                            }
                            ?>
                        </span>
                    </li>
                    <li class="list-group-item">
                        <b>Precio con descuento:</b> <span class="float-right">
                            <?php
                            if ($reg_ecommerce && floatval($product_wc->get_sale_price()) > 0) {
                                $precio_normal = floatval($products["val_ref"]);
                                $precio_descuento = floatval($product_wc->get_sale_price());
                                $calc_descuento = floatval((1 - ($precio_descuento / $precio_normal)) * 100);
                                echo "% " . esc_html(number_format($calc_descuento, 2, ',', '.'));
                            } else {
                                echo "% 0";
                            }
                            ?>
                        </span>
                    </li>
                    <li class="list-group-item">
                        <b>Stock minimo</b> <span class="float-right"><?php echo esc_html($products["stock_min"]) ?></span>
                    </li>
                    <li class="list-group-item">
                        <b>Rotacion</b> <span class="float-right">
                            <?php

                            switch ($products["rotacion"]) {
                                case '0':
                                    echo esc_html("BAJA ROTACIÓN");
                                    break;
                                case '1':
                                    echo esc_html("MEDIA ROTACIÓN");
                                    break;
                                case '2':
                                    echo esc_html("ALTA ROTACIÓN");
                                    break;
                            }
                            ?>
                        </span>
                    </li>
                </ul>
                <?php
                if ($reg_ecommerce) {
                    echo '<a href="';
                    echo esc_attr(get_permalink($product_wc->get_id()));
                    echo '" class="btn btn-primary btn-block" target="_blank"><b>Ver en E-commerce</b></a>';
                }
                ?>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>