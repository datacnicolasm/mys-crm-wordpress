<?php
try {
    if (isset($_GET["id-product"])) {
        $id_product = $_GET["id-product"];

        $parametros = array(
            'idrow' => $id_product
        );

        $products = json_decode(CRM_HUB_API::POST("product", $parametros), true)["data"];

        //echo '<pre>';
        //var_dump($products[0]);
        //var_dump($products[0]["nom_ref"]);
        //var_dump(wc_get_product());
        //echo '</pre>';
    };
} catch (Exception $e) {
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
}

$reg_ecommerce = false;

if (wc_get_product_id_by_sku($products[0]["cod_ref"]) == 0) {
    $reg_ecommerce = false;
} else {
    $reg_ecommerce = true;
    $product_wc = wc_get_product(wc_get_product_id_by_sku($products[0]["cod_ref"]));
}
?>
<div class="row">
    <!-- Columna de informacion del producto -->
    <div class="col-md-8">
        <!-- Columna de botones -->
        <div class="card card-primary card-outline card-crm-products-rigth">
            <div class="card-body card-buttons-product">
                <a class="btn btn-app bg-danger">
                    <i class="fas fa-edit"></i> Editar
                </a>
                <a class="btn btn-app bg-danger">
                    <i class="fas fa-file"></i> Ticket
                </a>
            </div>
        </div>
        <!-- Columna de informacion -->
        <div class="card card-primary card-outline card-crm-products-rigth">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#tickets" data-toggle="tab">Tickets</a></li>
                    <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>
                    <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">
                    <div class="active tab-pane" id="tickets">
                        <!-- Ticket -->
                        <div class="card-body p-0">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 20px">ID</th>
                                        <th class="text-center">Fecha</th>
                                        <th class="text-center">Tipo de ticket</th>
                                        <th class="text-center">Cliente</th>
                                        <th class="text-center">Estado</th>
                                        <th class="text-center" style="width: 100px">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Update software</td>
                                        <td>Update software</td>
                                        <td>Update software</td>
                                        <td>Update software</td>
                                        <td>Update software</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="timeline">
                        <!-- The timeline -->
                        <div class="timeline timeline-inverse">
                            <!-- timeline time label -->
                            <div class="time-label">
                                <span class="bg-danger">
                                    10 Feb. 2014
                                </span>
                            </div>
                            <!-- /.timeline-label -->
                            <!-- timeline item -->
                            <div>
                                <i class="fas fa-envelope bg-primary"></i>

                                <div class="timeline-item">
                                    <span class="time"><i class="far fa-clock"></i> 12:05</span>

                                    <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                                    <div class="timeline-body">
                                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                        weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                        jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                        quora plaxo ideeli hulu weebly balihoo...
                                    </div>
                                    <div class="timeline-footer">
                                        <a href="#" class="btn btn-primary btn-sm">Read more</a>
                                        <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                    </div>
                                </div>
                            </div>
                            <!-- END timeline item -->
                            <!-- timeline item -->
                            <div>
                                <i class="fas fa-user bg-info"></i>

                                <div class="timeline-item">
                                    <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>

                                    <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted your friend request
                                    </h3>
                                </div>
                            </div>
                            <!-- END timeline item -->
                            <!-- timeline item -->
                            <div>
                                <i class="fas fa-comments bg-warning"></i>

                                <div class="timeline-item">
                                    <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>

                                    <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                                    <div class="timeline-body">
                                        Take me to your leader!
                                        Switzerland is small and neutral!
                                        We are more like Germany, ambitious and misunderstood!
                                    </div>
                                    <div class="timeline-footer">
                                        <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                                    </div>
                                </div>
                            </div>
                            <!-- END timeline item -->
                            <!-- timeline time label -->
                            <div class="time-label">
                                <span class="bg-success">
                                    3 Jan. 2014
                                </span>
                            </div>
                            <!-- /.timeline-label -->
                            <!-- timeline item -->
                            <div>
                                <i class="fas fa-camera bg-purple"></i>

                                <div class="timeline-item">
                                    <span class="time"><i class="far fa-clock"></i> 2 days ago</span>

                                    <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                                    <div class="timeline-body">
                                        <img src="https://placehold.it/150x100" alt="...">
                                        <img src="https://placehold.it/150x100" alt="...">
                                        <img src="https://placehold.it/150x100" alt="...">
                                        <img src="https://placehold.it/150x100" alt="...">
                                    </div>
                                </div>
                            </div>
                            <!-- END timeline item -->
                            <div>
                                <i class="far fa-clock bg-gray"></i>
                            </div>
                        </div>
                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane" id="settings">
                        <form class="form-horizontal">
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputName" placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputName2" placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <button type="submit" class="btn btn-danger">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div><!-- /.card-body -->
        </div>
    </div>

    <!-- Columna de informacion del producto -->
    <div class="col-md-4">

        <!-- Imagen del producto -->
        <div class="card card-primary card-outline card-crm-products-left">
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
                <h4 class="profile-username text-center"><?php echo esc_html($products[0]["nom_ref"]) ?></h4>
                <p class="text-muted text-center"><?php echo "Cod. " . esc_html($products[0]["cod_ref"]) ?></p>

                <?php

                $reg_ecommerce = false;

                if (wc_get_product_id_by_sku($products[0]["cod_ref"]) == 0) {
                    echo '<div class="alert alert-warning text-center alert-crm">';
                    echo "Sin registro en E-commerce";
                    echo '</div>';
                } else {
                    $reg_ecommerce = true;
                    $product_wc = wc_get_product(wc_get_product_id_by_sku($products[0]["cod_ref"]));
                    echo '<div class="alert alert-success text-center alert-crm">';
                    echo 'Registrado en e-commerce';
                    echo '</div>';
                }

                ?>

                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Marca:</b> <span class="float-right"><?php echo esc_html($products[0]["brand"]["Nom_mar"]) ?></span>
                    </li>
                    <li class="list-group-item">
                        <b>Linea:</b> <span class="float-right"><?php echo esc_html($products[0]["type"]["nom_tip"]) ?></span>
                    </li>
                    <li class="list-group-item">
                        <b>Grupo:</b> <span class="float-right"><?php echo esc_html($products[0]["group"]["nom_gru"]) ?></span>
                    </li>
                    <li class="list-group-item">
                        <b>Precio de venta:</b> <span class="float-right">
                            <?php echo esc_html(number_format(floatval($products[0]["val_ref"]), 0, ',', '.')) ?>
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
                                $precio_normal = floatval($products[0]["val_ref"]);
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
                        <b>Stock minimo</b> <span class="float-right"><?php echo esc_html($products[0]["stock_min"]) ?></span>
                    </li>
                    <li class="list-group-item">
                        <b>Rotacion</b> <span class="float-right">
                            <?php

                            switch ($products[0]["rotacion"]) {
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
                    <li class="list-group-item">
                        <b>Indicador de rotacion</b> <a class="float-right">999</a>
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