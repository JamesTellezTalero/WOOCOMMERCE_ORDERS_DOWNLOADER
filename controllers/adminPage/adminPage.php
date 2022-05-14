<?php

class WOD_main_controller{

             // Here initialize our namespace and resource name.
    public function __construct() {
    
        $this->namespace     = '/my-namespace/v1';
        $this->resource_name = 'posts';

    }

}
// Function to register our new routes from the controller.
function prefix_register_my_rest_routes() {
    $controller = new WOD_main_controller();
    $controller->register_routes();
}

add_action( 'rest_api_init', 'prefix_register_my_rest_routes' );