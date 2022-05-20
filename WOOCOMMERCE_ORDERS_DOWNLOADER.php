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
			'WOD_admin_page_contents',
			'dashicons-pdf',
			3
		);

	}else{
		WOD_woocommerce_DontHaveInstall();

		return;
	}

}

add_action( "admin_menu" , "WOD_admin_menu" );


function WOD_register_style()
{
    // Register the style like this for a plugin:
    wp_register_style( 'adminStyles', plugins_url( '/src/css/adminStyles.css', __FILE__ ), array(), '20120208', 'all' );
 
    // For either a plugin or a theme, you can then enqueue the style:
    wp_enqueue_style( 'adminStyles' );
}
add_action( 'admin_head', 'WOD_register_style' );

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
function WOD_admin_page_contents() {

		?>

		<div class="WOD_admin-titleContainer">
		
			<h1 class="WOD_d-none">
				<?php esc_html_e( 'Woocommerce Orders Downloader.', 'woocommerce-orders-downloader' ); ?>
			</h1>

			<h1 class="WOD_admin-title">
				Elige el formato deseado
			</h1>

		</div>
			
<div class="WOD-card_container">

    <div class="WOD-card WOD_cardPDF">

        <div class="WOD-card_innerContent">

            <div>
			
				<h3 class="WOD-card_title">
					Ordenes Formato PDF
				</h3>

			</div>
			

			<img class="WOD-card_img" src="<?php echo WP_PLUGIN_URL;?>/WOOCOMMERCE_ORDERS_DOWNLOADER/src/img/pdf.png" alt="">

            <button class="WOD-card_button">Descargar</button>

        </div>
    
        <div class="WOD-card_overlay"></div>

    </div>
    <div class="WOD-card WOD_cardExcel">

        <div class="WOD-card_innerContent">

            <div>
			
				<h3 class="WOD-card_title">
					Ordenes Formato Excel
				</h3>

			</div>
			

			<img class="WOD-card_img" src="<?php echo WP_PLUGIN_URL;?>/WOOCOMMERCE_ORDERS_DOWNLOADER/src/img/excel.png" alt="">

            <button class="WOD-card_button">Descargar</button>

        </div>
    
        <div class="WOD-card_overlay"></div>

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
function WOD_register_required_plugins() {
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
add_action( 'tgmpa_register', 'WOD_register_required_plugins' );

/**
 * Get all yhe orders
 * 
 * @access public
 * @return void
 */
function WOD_get_orders(){
	/*
     ** PENNDING ORDERS
    */
    $pw_orders = []; // Array to collect customer IDs
    $pw_unpaid_orders = (array) wc_get_orders( array(

        'limit'        => -1,
        'status'       => 'pending',
        
    ));

    $pw_canceled_orders = (array) wc_get_orders( array(

        'limit'        => -1,
        'status'       => 'canceled',
        
    ));

    foreach ($pw_unpaid_orders as $order) { // Looping all orders to fetch customer IDs

        $pw_payment_method = $order;

		$order = wc_get_order($order);

		array_push($pw_orders, $order);
    }
    
	foreach ($pw_canceled_orders as $order) { // Looping all orders to fetch customer IDs

        $pw_payment_method = $order;

		$order = wc_get_order($order);

		array_push($pw_orders, $order);
    }

	var_dump($pw_orders);
}

add_action( "admin_head", "WOD_get_orders");