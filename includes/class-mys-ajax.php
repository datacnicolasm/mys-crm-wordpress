<?php

/**
 * Clase que responde y maneja las peticiones Ajax
 * 
 * @package     CRM_Motos
 */
class CRM_HUB_MYS_Ajax
{

    /**
     * Atributo asociado a la clase CRUD que interactua con la base de datoss
     */
    private $crud_db;

    /**
     * 
     */
    public function __construct()
    {

        $this->crud_db = new MYS_CRUD_DB();
    }

    /**
     * Function para responder con el correo de un usuario
     */
    public function get_email_user_wp()
    {
        check_ajax_referer('crm_token', 'security');

        global $wpdb;

        $cod_siasoft = sanitize_text_field($_POST['id']);

        // Consultar la base de datos para obtener el correo electrónico
        $user_email = $wpdb->get_var($wpdb->prepare(
            "SELECT user_email FROM {$wpdb->users} WHERE cod_siasoft = %s",
            $cod_siasoft
        ));

        if (!$user_email) {
            return new WP_Error( 'no_user', 'No user found with the provided cod_siasoft', array( 'status' => 404 ) );
        } else {
            wp_send_json_success(array( 'email' => $user_email ));
        }
    }
}
