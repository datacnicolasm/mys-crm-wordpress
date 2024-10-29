<?php
/**
 * 
 */
class CRM_HUB_MYS_Public {
    
    /**
	 * El identificador único de éste plugin
	 */
    private $plugin_name;
    
    /**
	 * Versión actual del plugin
	 */
    private $version;

    /**
     * Atributo asociado a la clase CRUD que interactua con la base de datos de SIASOFT
     */
    private $crud_db;
    
    public function __construct( $plugin_name, $version ) {
        
        $this->plugin_name  = $plugin_name;
        $this->version      = $version;
    }

}







