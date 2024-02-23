<?php

/**
 * Clase que consume api de Motos y servitecas
 * 
 * @package     CRM_Motos
 */
class CRM_HUB_API
{
    /**
     * 
     */
    public function __construct()
    {        
    }

    static function GET($url)
    {
        // Crea un nuevo recurso cURL
        $ch = curl_init();

        // Establece la URL y otras opciones apropiadas
        curl_setopt($ch, CURLOPT_URL, CRM_HUB_MYS_API_LARAVEL . $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // Captura la URL y la envía al navegador
        $response = curl_exec($ch);
        
        // Cierrar el recurso cURL y libera recursos del sistema
		curl_close ($ch);
		
        return $response;
    }

    static function POST($url, $data)
    {
        $datapost = '';
		foreach($data as $key=>$value) {
		    $datapost .= $key . "=" . $value . "&";
		}

        // Crea un nuevo recurso cURL
        $ch = curl_init();

        // Establece la URL y otras opciones apropiadas
        curl_setopt($ch, CURLOPT_URL, CRM_HUB_MYS_API_LARAVEL . $url);
		curl_setopt($ch,CURLOPT_POST, 1);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$datapost);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT ,3);
		curl_setopt($ch,CURLOPT_TIMEOUT, 20);

        // Captura la URL y la envía al navegador
        $response = curl_exec($ch);

        // Cierrar el recurso cURL y libera recursos del sistema
		curl_close ($ch);

        return $response;


    }

}

?>