<?php

/**
 * 
 * 
 * @package     CRM_Motos
 */
class CRM_HUB_MYS_CRUD_DB
{
    /**
     * 
     */
    private $db;

    /**
     * 
     */
    public function __construct()
    {
        
        global $wpdb;
        $this->db = $wpdb;
        
    }
}