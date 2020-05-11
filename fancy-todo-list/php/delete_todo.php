<?php




function delete_to_do_ajax_handler() {
	
	if ( isset($_REQUEST) ) {
		
		
		// Check for nonce security
		$nonce = $_REQUEST['nonce'];
		
		if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
			die ( 'Not nice' );

		$post_id_to_delete = $_REQUEST['post_id_to_delete'];
		
		if( isset( $post_id_to_delete ) ) {
			
			$post_id_to_delete = sanitize_text_field( $post_id_to_delete );
			
			
			if( get_post_type( $post_id_to_delete ) ==  'ftdl_todo' ) {
				
				wp_delete_post( $post_id_to_delete );
				
				echo "Deleted to does successfully";
			}
			else {
				echo "This ID is not to do!";
			}
		}
		else {
			echo "Can't delete todo";
			
		}
		
	}
	
	die();
}
add_action( 'wp_ajax_delete_to_do_ajax_handler', 'delete_to_do_ajax_handler' );




?>