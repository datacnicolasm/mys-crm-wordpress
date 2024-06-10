<?php

/**
 * La funcionalidad específica de administración del plugin.
 *
 * @package     CRM_Motos
 */

/**
 * Define el nombre del plugin, la versión y dos métodos para la hoja de estilos específica de administración y JavaScript.
 * 
 * @since      1.0.0
 * @package    Beziercode-Blank
 * @author     Nicolas Muñoz
 */
class CRM_HUB_MYS_Admin {
    
    private $plugin_name;
    private $version;
    private $menu_admin;
    private $crud_db;
    
    public function __construct( $plugin_name, $version ) {
        
        $this->plugin_name = $plugin_name;
        $this->version = $version;  
        $this->menu_admin = new CRM_HUB_MYS_Menus();
        $this->crud_db = new MYS_CRUD_DB();
        
    }
    
    /**
	 * Registra los archivos de hojas de estilos del área de administración.
	 */
    public function enqueue_styles() {
        
		wp_enqueue_style( $this->plugin_name, CRM_HUB_MYS_PLUGIN_URL . '/admin/css/bc-admin.css', array(), $this->version, 'all' );
        //wp_enqueue_style( 'GoogleFont', 'https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback', array(), $this->version, 'all' );
        wp_enqueue_style( 'FontAwesome', CRM_HUB_MYS_PLUGIN_URL . '/admin/plugins/fontawesome-free/css/all.min.css', array(), $this->version, 'all' );
        wp_enqueue_style( 'Ionicons', 'https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css', array(), $this->version, 'all' );
        wp_enqueue_style( 'TempusdominusBootstrap4', CRM_HUB_MYS_PLUGIN_URL . '/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css', array(), $this->version, 'all' );
        wp_enqueue_style( 'DataTablesBS4', CRM_HUB_MYS_PLUGIN_URL . '/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css', array(), $this->version, 'all' );
        wp_enqueue_style( 'DataTablesResponsive', CRM_HUB_MYS_PLUGIN_URL . '/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css', array(), $this->version, 'all' );
        wp_enqueue_style( 'DataTablesButtons', CRM_HUB_MYS_PLUGIN_URL . '/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css', array(), $this->version, 'all' );
        wp_enqueue_style( 'iCheck', CRM_HUB_MYS_PLUGIN_URL . '/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css', array(), $this->version, 'all' );
        wp_enqueue_style( 'JQVMap', CRM_HUB_MYS_PLUGIN_URL . '/admin/plugins/jqvmap/jqvmap.min.css', array(), $this->version, 'all' );
        wp_enqueue_style( 'ThemeStyle', CRM_HUB_MYS_PLUGIN_URL . '/admin/dist/css/adminlte.min.css', array(), $this->version, 'all' );
        wp_enqueue_style( 'overlayScrollbars', CRM_HUB_MYS_PLUGIN_URL . '/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css', array(), $this->version, 'all' );
        wp_enqueue_style( 'DaterangePicker', CRM_HUB_MYS_PLUGIN_URL . '/admin/plugins/daterangepicker/daterangepicker.css', array(), $this->version, 'all' );
        wp_enqueue_style( 'summernote', CRM_HUB_MYS_PLUGIN_URL . '/admin/plugins/summernote/summernote-bs4.min.css', array(), $this->version, 'all' );
        
    }
    
    /**
	 * Registra los archivos Javascript del área de administración.
	 */
    public function enqueue_scripts() {
        wp_enqueue_editor();

        wp_enqueue_script( 'GSAP', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js', [], $this->version, true);
        wp_enqueue_script( 'ScrollTrigger', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/ScrollTrigger.min.js', [], $this->version, true);

        wp_enqueue_script( 'jquery.dataTables', CRM_HUB_MYS_PLUGIN_URL . '/admin/plugins/datatables/jquery.dataTables.min.js', ['jquery'], $this->version, true);
        wp_enqueue_script( 'dataTables.bootstrap4', CRM_HUB_MYS_PLUGIN_URL . '/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js', ['jquery'], $this->version, true);
        wp_enqueue_script( 'dataTables.responsive', CRM_HUB_MYS_PLUGIN_URL . '/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js', ['jquery'], $this->version, true);
        wp_enqueue_script( 'responsive.bootstrap4', CRM_HUB_MYS_PLUGIN_URL . '/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js', ['jquery'], $this->version, true);
        wp_enqueue_script( 'dataTables.buttons', CRM_HUB_MYS_PLUGIN_URL . '/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js', ['jquery'], $this->version, true);
        wp_enqueue_script( 'buttons.bootstrap4', CRM_HUB_MYS_PLUGIN_URL . '/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js', ['jquery'], $this->version, true);
        wp_enqueue_script( 'jszip', CRM_HUB_MYS_PLUGIN_URL . '/admin/plugins/jszip/jszip.min.js', ['jquery'], $this->version, true);
        wp_enqueue_script( 'pdfmake', CRM_HUB_MYS_PLUGIN_URL . '/admin/plugins/pdfmake/pdfmake.min.js', ['jquery'], $this->version, true);
        wp_enqueue_script( 'vfs_fonts', CRM_HUB_MYS_PLUGIN_URL . '/admin/plugins/pdfmake/vfs_fonts.js', ['jquery'], $this->version, true);
        wp_enqueue_script( 'html5', CRM_HUB_MYS_PLUGIN_URL . '/admin/plugins/datatables-buttons/js/buttons.html5.min.js', ['jquery'], $this->version, true);
        wp_enqueue_script( 'print', CRM_HUB_MYS_PLUGIN_URL . '/admin/plugins/datatables-buttons/js/buttons.print.min.js', ['jquery'], $this->version, true);
        wp_enqueue_script( 'colVis', CRM_HUB_MYS_PLUGIN_URL . '/admin/plugins/datatables-buttons/js/buttons.colVis.min.js', ['jquery'], $this->version, true);



        wp_enqueue_script( 'jQueryUI', CRM_HUB_MYS_PLUGIN_URL . "/admin/plugins/jquery-ui/jquery-ui.min.js", ['jquery'], $this->version, true );
        wp_enqueue_script( 'Bootstrap4', CRM_HUB_MYS_PLUGIN_URL . "/admin/plugins/bootstrap/js/bootstrap.bundle.min.js", array(), $this->version, true );
        wp_enqueue_script( 'ChartJS', CRM_HUB_MYS_PLUGIN_URL . "/admin/plugins/chart.js/Chart.min.js", array(), $this->version, true );
        wp_enqueue_script( 'Sparkline', CRM_HUB_MYS_PLUGIN_URL . "/admin/plugins/sparklines/sparkline.js", array(), $this->version, true );
        wp_enqueue_script( 'JQVMap', CRM_HUB_MYS_PLUGIN_URL . "/admin/plugins/jqvmap/jquery.vmap.min.js", array(), $this->version, true );
        wp_enqueue_script( 'JQVMapUSA', CRM_HUB_MYS_PLUGIN_URL . "/admin/plugins/jqvmap/maps/jquery.vmap.usa.js", array(), $this->version, true );
        wp_enqueue_script( 'jQueryKnobChart', CRM_HUB_MYS_PLUGIN_URL . "/admin/plugins/jquery-knob/jquery.knob.min.js", array(), $this->version, true );
        wp_enqueue_script( 'moment', CRM_HUB_MYS_PLUGIN_URL . "/admin/plugins/moment/moment.min.js", array(), $this->version, true );
        wp_enqueue_script( 'daterangepicker', CRM_HUB_MYS_PLUGIN_URL . "/admin/plugins/daterangepicker/daterangepicker.js", array(), $this->version, true );
        wp_enqueue_script( 'TempusdominusBootstrap4', CRM_HUB_MYS_PLUGIN_URL . "/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js", array(), $this->version, true );
        wp_enqueue_script( 'Summernote', CRM_HUB_MYS_PLUGIN_URL . "/admin/plugins/summernote/summernote-bs4.min.js", array(), $this->version, true );
        wp_enqueue_script( 'overlayScrollbars', CRM_HUB_MYS_PLUGIN_URL . "/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js", array(), $this->version, true );
        wp_enqueue_script( 'AdminLTEApp', CRM_HUB_MYS_PLUGIN_URL . "/admin/dist/js/adminlte.js", ['jquery'], $this->version, true );
        wp_enqueue_script( 'AdminLTEdemo', CRM_HUB_MYS_PLUGIN_URL . "/admin/dist/js/demo.js", ['jquery'], $this->version, true );
        wp_enqueue_script( $this->plugin_name, CRM_HUB_MYS_PLUGIN_URL . '/admin/js/bc-admin.js', ['jquery','jQueryUI','Bootstrap4','ChartJS','Sparkline','JQVMap','JQVMapUSA','jQueryKnobChart','moment','daterangepicker','TempusdominusBootstrap4','Summernote','overlayScrollbars','AdminLTEApp','AdminLTEdemo','GSAP','ScrollTrigger'], $this->version, true );
        
        wp_localize_script(
            $this->plugin_name,
            'object_ajax',
            [
                'url' => admin_url('admin-ajax.php'),
                'token' => wp_create_nonce('crm_token')
            ]
        );
        
    }

    /**
     * Funcion para registrar menu principal.
     */
    public function add_menu()
    {
        $this->menu_admin->add_menu_page(
            __('CRM HUB','mys_crm_hub'),
            __('CRM HUB','mys_crm_hub'),
            'manage_options',
            'mys_crm_hub',
            [$this, 'control_display_menu'],
            '',
            15
        );

        $this->menu_admin->run();
    }

    /**
     * Funcion para usar vista de pagina admin.
     */
    public function control_display_menu()
    {
        require_once CRM_HUB_MYS_DIR . 'admin/partials/mys-admin-display.php';
    }
    
}