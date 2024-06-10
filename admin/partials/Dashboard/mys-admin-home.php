<?php
try {
    $parametros = array(
        'cod_mer' => $user_sia["cod_mer"],
        'time_month' => '2'
    );

    $headers = [
        'Authorization: ' . CRM_HUB_MYS_API_TOKEN,
    ];

    $tickets = json_decode(CRM_HUB_API::POST("indexUserFilter", $parametros, $headers), true)["data"];
} catch (Exception $e) {
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
}

/*
0:Pendiente
1:En proceso
2:Vendido
3:Venta perdidá
*/

$count_pendientes = 0;
$count_vendidos = 0;
$count_perdidos = 0;
$count_proceso = 0;

if (count($tickets) > 0)
{
    foreach ($tickets as $key => $ticket) {
    
        if ($ticket["cod_estado"] == "0")
        { 
    
            $count_pendientes += 1;
    
        } else if ($ticket["cod_estado"] == "1")
        {
    
            $count_proceso += 1;
    
        } else if ($ticket["cod_estado"] == "2")
        {
    
            $count_vendidos += 1;
    
        } else if ($ticket["cod_estado"] == "3")
        {
            
            $count_perdidos += 1;
    
        };
        
    }
}
?>

<!-- Indicadores principales -->
<div class="row">
    <!-- # Tickets pendientes -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?php echo $count_pendientes ?></h3>

                <p>Tickets pendientes</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <?php
            echo '<a href="';
            echo get_admin_url();
            echo 'admin.php?page=mys_crm_hub&sub-page=tickets';
            echo '" class="small-box-footer"> Ver info ';
            echo '<i class="fas fa-arrow-circle-right"></i></a>';
            ?>
        </div>
    </div>

    <!-- # Tickets vendidos -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?php echo $count_vendidos ?></h3>

                <p>Tickets vendidos</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <?php
            echo '<a href="';
            echo get_admin_url();
            echo 'admin.php?page=mys_crm_hub&sub-page=tickets';
            echo '" class="small-box-footer"> Ver info ';
            echo '<i class="fas fa-arrow-circle-right"></i></a>';
            ?>
        </div>
    </div>
    
    <!-- # Tickets perdidos -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3><?php echo $count_perdidos ?></h3>

                <p>Tickets perdidos</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <?php
            echo '<a href="';
            echo get_admin_url();
            echo 'admin.php?page=mys_crm_hub&sub-page=tickets';
            echo '" class="small-box-footer"> Ver info ';
            echo '<i class="fas fa-arrow-circle-right"></i></a>';
            ?>
        </div>
    </div>

    <!-- # Tickets en proceso -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3><?php echo $count_proceso ?></h3>

                <p>Tickets en proceso</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <?php
            echo '<a href="';
            echo get_admin_url();
            echo 'admin.php?page=mys_crm_hub&sub-page=tickets';
            echo '" class="small-box-footer"> Ver info ';
            echo '<i class="fas fa-arrow-circle-right"></i></a>';
            ?>
        </div>
    </div>
</div>