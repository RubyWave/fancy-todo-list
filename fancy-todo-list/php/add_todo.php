<?php



function add_new_todo_ajax_handler() {
 
	// The $_REQUEST contains all the data sent via ajax
	if ( isset($_REQUEST) ) {
		
		
		// Check for nonce security
		$nonce = $_REQUEST['nonce'];
		
		if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
			die ( 'Not nice' );

		$new_to_do_name = $_REQUEST['new_to_do_name'];


		if( !empty( $new_to_do_name ) ) {
			//clear input from any bad stuff
			$new_to_do_name = sanitize_text_field( $new_to_do_name );
			
			
			
			$post_settings = array(
				'post_title' => $new_to_do_name,
				'post_status' => 'publish',
				'post_type' => 'ftdl_todo',
			);

			$new_post_ID = wp_insert_post( $post_settings );
			
			if( $new_post_ID ) {
				add_post_meta( $new_post_ID, 'status', 'pending' );
			}
			
			
			
			
			
			echo "Added to-do with name: " . $new_to_do_name;
		
		}
		else {
			echo "No name given";
			
		}
		
	}
	die();
}
add_action( 'wp_ajax_add_new_todo_ajax_handler', 'add_new_todo_ajax_handler' );




?>