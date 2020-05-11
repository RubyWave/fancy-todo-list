<?php
   /*
   Plugin Name: Fancy To-Do List
   description: Plugin to showup my skills
   Version: 1.0
   Author: Karol
   Prefix: ftdl_
   */
?>
<?php



//adding scripts in footer
function load_extra_files_init() {
	wp_enqueue_script( 'jquery' );
	
    wp_enqueue_script( 'plugin-AJAXcalls', plugins_url( '/js/AJAXcalls.js', __FILE__ ), array(), false, true);
    wp_enqueue_script( 'plugin-script', plugins_url( '/js/script.js', __FILE__ ), array(), false, true);
    
	
	
	wp_localize_script(
		'plugin-AJAXcalls',
		'dataForAJAX',
		array( 
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'nonce' => wp_create_nonce('ajax-nonce')
			)
	);
	
	wp_localize_script(
		'plugin-script',
		'dataForAJAX',
		array( 
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'nonce' => wp_create_nonce('ajax-nonce')
			)
	);
	
}
add_action('wp_enqueue_scripts','load_extra_files_init');


function load_styles_in_footer() {
    wp_enqueue_style( 'style', plugins_url( '/css/style.css', __FILE__ ));
};
add_action( 'get_footer', 'load_styles_in_footer' );







//shortcode to add table
function todo_list_fun( $atts ){
	return create_to_do_list();
}
add_shortcode( 'todo-list', 'todo_list_fun' );






//adding extra files
require_once dirname( __FILE__ ) .'/php/delete_todo.php';
require_once dirname( __FILE__ ) .'/php/display_refresh_list.php';
require_once dirname( __FILE__ ) .'/php/add_todo.php';
require_once dirname( __FILE__ ) .'/php/change_todo_name.php';
require_once dirname( __FILE__ ) .'/php/change_todo_status.php';







//creating custom post type: To-do
function ftdl_custom_post_type() {
	register_post_type('ftdl_todo',
		array(
			'labels'      => array(
			'name'          => __('To-dos', 'textdomain'),
			'singular_name' => __('To-do', 'textdomain'),
			),
			'public'      => false,
		)
	);
}
add_action('init', 'ftdl_custom_post_type');

?>
