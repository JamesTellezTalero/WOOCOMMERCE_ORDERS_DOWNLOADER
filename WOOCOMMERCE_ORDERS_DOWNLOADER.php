<?php 

/**
 * Plugin Name:       Woocommerce Orders Downloader
 * Plugin URI:        https://github.com/JayEx-dev/WOOCOMMERCE_ORDERS_DOWNLOADER
 * Description:       Pizza mannagment for Woocommerce
 * Version:           1.0.0
 * Requires at least: 5.3
 * Requires PHP:      8.1
 * Author:            James tellez
 * Author URI:        https://github.com/JayEx-dev
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://github.com/JayEx-dev/WOOCOMMERCE_ORDERS_DOWNLOADER
 * Text Domain:       woocommerce-orders-downloader
 * Domain Path:       /languages
 */

/**
 * WOD
**/
 ///ENQUEUE SCRIPT FOR LOCAL STORAGE 
 defined('ABSPATH') or die ('Unauthorized Access');

// use Controllers\adminPage\WodMainController;



function WOD_admin_menu(){

	// $controller = new WodMainController;
        /***
        **** Admin menu bar
        ***/

    add_menu_page(
		__( 'Woocommerce Orders Downloader', 'woocommerce-orders-downloader' ),
		__( 'Orders', 'woocommerce-orders-downloader' ),
		'manage_options',
		'woocommerce-orders-downloader',
		'my_admin_page_contents',
		'dashicons-pdf',
		3
	);

}

add_action( "admin_menu" , "WOD_admin_menu" );

/**
 * Creamos la vista de administrador
 * 
 * @access public
 * @return void
 */
function my_admin_page_contents() {
		?>
			<h1>
				<?php esc_html_e( 'Welcome to my custom admin page.', 'my-plugin-textdomain' ); ?>
			</h1>
		<?php

		if ( is_plugin_active('woocommerce/woocommerce.php') ) {
  			echo "<br>";
  			echo "woocommerce is active";
  			echo "<br>";
		}
}

/**
 * Generamos la dependencia con woocommerce
 * 
 * @access public
 * @return void
 */
function register_required_plugins() {
    // Variables
    $plugins  = array(
        // Mi plugin o tema necesita del plugin WP REST API para funcionar correctamente
        array(
            'name'               => 'woocommerce',  // El nombre del plugin.
            'slug'               => 'woocommerce',     // El "slug" del plugin (normalmente el nombre de la carpeta).
            'required'           => true            // Si es falso, el plugin es "recomendado" en lugar de "requerido".
        )
    );

    // LLamar a la función de la librería
    // que se encargará de las dependencias.
    tgmpa( $plugins);
}
add_action( 'tgmpa_register', 'register_required_plugins' );


