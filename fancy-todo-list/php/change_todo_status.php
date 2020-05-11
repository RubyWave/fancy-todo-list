<?php

function change_status_ajax_handler() {
	
	
	// The $_REQUEST contains all the data sent via ajax
	if ( isset($_REQUEST) ) {
	
	
		// Check for nonce security
		$nonce = $_REQUEST['nonce'];
		
		if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
			die ( 'Not nice' );

		$to_do_id_to_change = $_REQUEST['to_do_id_to_change'];


		if( !empty( $to_do_id_to_change ) ) {
			//clear input from any bad stuff
			$to_do_id_to_change = sanitize_text_field( $to_do_id_to_change );
			
			
			if( get_post_type( $to_do_id_to_change ) ==  'ftdl_todo' ) {
				
				$old_status = get_post_meta($to_do_id_to_change, 'status')[0];
			
				if( get_post_meta($to_do_id_to_change, 'status')[0] == 'pending' ) {
					
					delete_post_meta($to_do_id_to_change, 'status');
					add_post_meta( $to_do_id_to_change, 'status', 'done' );
					
				}
				else {
					delete_post_meta($to_do_id_to_change, 'status');
					add_post_meta( $to_do_id_to_change, 'status', 'pending' );
				}
			
				echo "Changed status of: " . $to_do_id_to_change . ' to: ' . get_post_meta($to_do_id_to_change, 'status')[0] . ' of to do with id: ' . $to_do_id_to_change . ' status was: ' . $old_status;
			}
			else {
				echo "This ID is not to do!";
			}
			
			
			
		
		}
		else {
			echo "Can't change status";
			
		}
		
	}
	
	die();
}
add_action( 'wp_ajax_change_status_ajax_handler', 'change_status_ajax_handler' );

?>