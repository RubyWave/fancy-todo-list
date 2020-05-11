<?php

function create_to_do_list() {
	
	$all_todos = array();
	
	
	
	$query = new WP_Query(array(
		'post_type' => 'ftdl_todo',
		'post_status' => 'publish',
		'posts_per_page' => -1,
	));
	
	if($query) {
		while ($query->have_posts()) {
			$query->the_post();
			
			$to_do_status = get_post_meta(get_the_ID(), 'status')[0];
			
			$open_tag = '<li class="one-to-do" data-post-id="' . get_the_ID() . '" data-status="' . $to_do_status . '" >';
			
			$ifchecked = '';
			if($to_do_status == 'done') {
				$ifchecked = 'checked';
			}
			
			$checkbox = '<div class="checkbox-wrapper"><input class="pseudo-checkbox" type="checkbox"' . $ifchecked . ' /></div>';
			
			$del_option = '<span class="delete-this" style="float: right;">Del...</span>';
			
			$close_tag = '</li>';
			
			$one_line = $open_tag . $checkbox . '<input type="text" class="todo-title" autocomplete="off" value="' . get_the_title() . '"></input>' . $del_option .  $close_tag;
			array_push( $all_todos, $one_line );
		}
	}
	$output =  $all_todos;
	
	$extra_form = '<li class="one-to-do"><div class="checkbox-wrapper"><input type="checkbox"/></div><input class="new-todo-name" type="text" autocomplete="off" placeholder="Enter new task here..."></input></li>';
	
	
	return '<div class="whole-todo-table-wrapper">' . '<ul class="to-dos-table">'. $extra_form . implode($output) . '</ul></div>';
}



function refresh_to_do_list_ajax_handler() {
	
	if ( isset($_REQUEST) ) {
	
		// Check for nonce security
		$nonce = $_REQUEST['nonce'];
		
		if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
			die ( 'Not nice' );
		
		
		
		
		echo create_to_do_list();
		
		die();
	}
}
add_action( 'wp_ajax_refresh_to_do_list_ajax_handler', 'refresh_to_do_list_ajax_handler' );

?>