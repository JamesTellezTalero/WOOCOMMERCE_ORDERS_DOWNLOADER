<?php

namespace Controllers\adminPage;

class WodMainController{

             // Here initialize our namespace and resource name.
    public function __construct() {
    
        $this->namespace     = '/woocommerce-orders-downloader/';
        $this->resource_name = 'posts';

    }

    // public function register_routes() {
    //     register_rest_route( $this->namespace, '/' . $this->resource_name, array(
    //         // Here we register the readable endpoint for collections.
    //         array(
    //             'methods'   => 'GET',
    //             'callback'  => array( $this, ' my_admin_page_contents' ),
    //             'permission_callback' => array( $this, 'get_items_permissions_check' ),
    //         ),
    //         // Register our schema callback.
    //         'schema' => array( $this, 'get_item_schema' ),
    //     ) );
    // }


    // function get_items_permissions_check(){}

}
// Function to register our new routes from the controller.
function prefix_register_my_rest_routes() {
    $controller = new WodMainController();
    $controller->register_routes();
}

add_action( 'rest_api_init', 'prefix_register_my_rest_routes' );

add_action( 'init', function(){
	$class = new WodMainController();
});