<?php 

function change_name_ajax_handler() {
	
	
	// The $_REQUEST contains all the data sent via ajax
	if ( isset($_REQUEST) ) {
		
		
		// Check for nonce security
		$nonce = $_REQUEST['nonce'];
		
		if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
			die ( 'Not nice' );

		$to_do_id_to_change = $_REQUEST['to_do_id_to_change'];
		$to_do_name_to_change = $_REQUEST['to_do_name_to_change'];


		if( !empty( $to_do_id_to_change ) && !empty( $to_do_name_to_change) ) {
			//clear input from any bad stuff
			$to_do_id_to_change = sanitize_text_field( $to_do_id_to_change );
			$to_do_name_to_change = sanitize_text_field( $to_do_name_to_change );
			
			
			if( get_post_type( $to_do_id_to_change ) ==  'ftdl_todo' ) {
				
				
				$updatePost = array(   
					'ID' => $to_do_id_to_change,
					'post_title' => $to_do_name_to_change
				);

				wp_update_post( $updatePost );
				
				echo 'Changed name';
			}
			else {
				echo "This ID is not to do!";
			}	
		}
		else {
			echo "Can't change name";
			
		}
		
	}
	
	die();
}
add_action( 'wp_ajax_change_name_ajax_handler', 'change_name_ajax_handler' );

?>