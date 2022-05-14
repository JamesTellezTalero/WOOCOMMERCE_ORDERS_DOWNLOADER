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
 *
**/

 ///ENQUEUE SCRIPT FOR LOCAL STORAGE 
 defined('ABSPATH') or die ('Unauthorized Access');

function WOD_init(){

        /***
        **** Admin menu bar
        ***/

        $page_title = "Woocommerce Orders Downloader";
        
        $menu_title = "Orders";
        
        $capability = "Editor";
        
        $menu_slug = "woocommerce-orders-downloader";

        $position = 1;

        add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function = '', $icon_url = '', $position );

}

register_activation_hook( __DIR__, "WOD_init" );