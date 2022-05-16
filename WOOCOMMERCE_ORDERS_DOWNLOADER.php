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

	if ( is_plugin_active('woocommerce/woocommerce.php') ) {
    
		add_menu_page(
			__( 'Woocommerce Orders Downloader', 'woocommerce-orders-downloader' ),
			__( 'Orders', 'woocommerce-orders-downloader' ),
			'manage_options',
			'woocommerce-orders-downloader',
			'my_admin_page_contents',
			'dashicons-pdf',
			3
		);

	}else{
		WOD_woocommerce_DontHaveInstall();

		return;
	}

}

add_action( "admin_menu" , "WOD_admin_menu" );


function wptuts_styles_with_the_lot()
{
    // Register the style like this for a plugin:
    wp_register_style( 'adminStyles', plugins_url( '/src/css/adminStyles.css', __FILE__ ), array(), '20120208', 'all' );
 
    // For either a plugin or a theme, you can then enqueue the style:
    wp_enqueue_style( 'adminStyles' );
}
add_action( 'wp_enqueue_scripts', 'wptuts_styles_with_the_lot' );

/**
 * DISPLAY ALERT IF WE DONT HAD WOOCOMMERCE
 * 
 * @access public
 * @return void
 */
function WOD_woocommerce_DontHaveInstall() {
	$class = 'notice notice-error';
	$message = __( 'Ups... No tienes activado/instalado el plugin Woocomerce', 'sample-text-domain' );

	printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) ); 
}

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
			
<div class="WOD-card_container">

    <div class="WOD-card">
    
        <div class="WOD-card_overlay"></div>

        <div class="WOD-card_innerContent">

            <h1 class="WOD-card_title">
            Lorem, ipsum.
            </h1>

            <h3 class="WOD-card_type">
                Lorem ipsum dolor sit.
            </h3>

            <button class="WOD-card_button">Lorem.</button>

        </div>

    </div>
    <div class="WOD-card">
    
        <div class="WOD-card_overlay"></div>

        <div class="WOD-card_innerContent">

            <h1 class="WOD-card_title">
            Lorem, ipsum.
            </h1>

            <h3 class="WOD-card_type">
                Lorem ipsum dolor sit.
            </h3>

            <button class="WOD-card_button">Lorem.</button>

        </div>

    </div>

</div>

		<?php

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


