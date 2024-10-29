<?php
/**
 * Plugin Name:     CRM de Motos y Servitecas
 * Plugin URI:      https://motosyservitecas.com/
 * Description:     Plugin para CRM de Motos y Servitecas.
 * Version:         1.0.0
 * Author:          Nicolas Munoz
 * Author URI:      https://motosyservitecas.com/
 * Text Domain:     mys_crm_hub
 *
 * @package     CRM_Motos
 */
 
defined( 'ABSPATH' ) || die();

global $wpdb;
 
define( 'CRM_HUB_MYS_API_TOKEN', '9c296f109cbfa21632dc522a3aade323' );
#define( 'CRM_HUB_MYS_API_LARAVEL', 'http://localhost/my-api/public/' );
define( 'CRM_HUB_MYS_API_LARAVEL', 'https://my-laravel-app-ljafsi4dzq-uc.a.run.app/' );
#define( 'CRM_HUB_MYS_API_LARAVEL', 'http://localhost:8080/' );
define( 'CRM_HUB_MYS_DIR', plugin_dir_path( __FILE__ ) );
define( 'CRM_HUB_MYS_PLUGIN_FILE', __FILE__ );
define( 'CRM_HUB_MYS_PLUGIN_URL', plugins_url() . '/mys-crm-hub' );
define( 'CRM_HUB_MYS_VERSION', '1.0.0' );
//define( 'CRM_HUB_MYS_CLIENTES_TABLE', "{$wpdb->prefix}servicios_mys_clientes" );
define( 'CRM_HUB_MYS_TEXT_DOMAIN', 'mys_crm_hub' );

/**
 * Código que se ejecuta en la activación del plugin
 */
function mys_crm_hub_activate() {
    require_once CRM_HUB_MYS_DIR . 'includes/class-mys-crm-activator.php';
	CRM_HUB_MYS_Activator::activate();
}
register_activation_hook( __FILE__, 'mys_crm_hub_activate' );

/**
 * Código que se ejecuta en la desactivación del plugin
 */
function mys_crm_hub_deactivate() {
    require_once CRM_HUB_MYS_DIR . 'includes/class-mys-crm-deactivator.php';
	CRM_HUB_MYS_Deactivator::deactivate();
}
register_deactivation_hook( __FILE__, 'mys_crm_hub_deactivate' );
 
/**
 * Requiriendo la clase master
 */
require_once CRM_HUB_MYS_DIR . 'includes/class-mys-crm-master.php';

/**
 * Funcion para iniciar la clase master
 */
function mys_crm_hub_run_master_class_plugin(){
    $master = new CRM_HUB_MYS_Master();
    $master->init();
}

mys_crm_hub_run_master_class_plugin();