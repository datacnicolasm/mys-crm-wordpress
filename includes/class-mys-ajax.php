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

}

?>