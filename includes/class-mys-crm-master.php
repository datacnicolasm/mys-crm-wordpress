<?php
require_once 'class-mys-crm-ajax.php';
require_once 'class-mys-crm-cargador.php';
require_once 'class-mys-crm-menus.php';

/**
 * Clase master que incluye otras clases auxiliares
 * 
 * @package     CRM_Motos
 */
class CRM_HUB_MYS_Master
{
    /**
     * Clase cargador para los hooks de Wordpress
     */
    protected $class_cargador;

    /**
     * Clase para el manejo en la administración de Wordpress
     */
    protected $class_admin;

    /**
     * Clase para agregar menus y sub menus en el panel de Wordpress
     */
    public $class_menus;

    /**
     * Clase para manejar las peticiones Ajax Jquery
     */
    public $class_ajax;

    /**
     * Clase para manejar las peticiones Ajax Jquery
     */
    public $class_public;

    /**
     * Metodo contructor de la clase
     */
    public function __construct()
    {
        $this->cargar_clases();
        $this->cargar_instancias();
        $this->definir_admin_hooks();
        $this->definir_public_hooks();
    }

    /**
     * Método para requerir las clases complementarias
     */
    public function cargar_clases()
    {
        require_once CRM_HUB_MYS_DIR . 'includes/class-mys-crm-api.php';

        /**
         * Clase de cargador para los hooks de Wordpress
         */
        require_once CRM_HUB_MYS_DIR . 'includes/class-mys-crm-cargador.php';

        /**
         * Clase de menús para agregar items en el panel de Wordpress
         */
        require_once CRM_HUB_MYS_DIR . 'includes/class-mys-crm-menus.php';

        /**
         * Clase de interacción con la base de datos
         */
        require_once CRM_HUB_MYS_DIR . 'includes/class-mys-crm-crud-db.php';

        /**
         * Clase de métodos en el panel de Wordpress
         */
        require_once CRM_HUB_MYS_DIR . 'admin/class-mys-crm-admin.php';

        /**
         * Clase de métodos en el formulario publico
         */
        require_once CRM_HUB_MYS_DIR . 'public/class-mys-crm-public.php';
    }

    /**
     * Método que inicializa las clases asociadas a los atributos de la clase master
     */
    private function cargar_instancias()
    {
        $this->class_cargador =     new CRM_HUB_MYS_Cargador();
        $this->class_admin =        new CRM_HUB_MYS_Admin('mys_crm_hub', CRM_HUB_MYS_VERSION);
        //$this->class_public =       new CRM_HUB_MYS_Public('mys_woocommerce_service',CRM_HUB_MYS_VERSION);
        $this->class_ajax =         new CRM_HUB_MYS_Ajax();
    }

    /**
     * Método que agrega las funciones en los hooks de admin
     */
    private function definir_admin_hooks()
    {

        $this->class_cargador->add_list_action('admin_enqueue_scripts', $this->class_admin, 'enqueue_styles');
        $this->class_cargador->add_list_action('admin_enqueue_scripts', $this->class_admin, 'enqueue_scripts');
        $this->class_cargador->add_list_action('admin_menu', $this->class_admin, 'add_menu');
        $this->class_cargador->add_list_action('wp_ajax_get_email_user_wp', $this->class_ajax, 'get_email_user_wp');
    }

    /**
     * Método que agrega las funciones en los hooks publicos
     */
    private function definir_public_hooks()
    {
    }

    /**
     * Método que carga las funciones en los hooks usando la clase cargador
     */
    public function init()
    {
        $this->class_cargador->run();
    }
}
