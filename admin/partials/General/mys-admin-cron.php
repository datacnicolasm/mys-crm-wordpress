<?php

$parametros = array(
    'cod_mer' => $current_user->data->cod_siasoft
);

$headers = [
    'Authorization: ' . CRM_HUB_MYS_API_TOKEN,
];

$notices_referencias = json_decode(CRM_HUB_API::POST("userTicketsReferencias", $parametros, $headers), true)["data"];

?>