
refreshListAJAX = function(){

	jQuery.ajax({
		url: dataForAJAX.ajaxurl,
		data: {
			'action': 'refresh_to_do_list_ajax_handler',
			'nonce' : dataForAJAX.nonce
		},
		success:function(data) {
			jQuery(".whole-todo-table-wrapper").replaceWith( data );
			assingButtonFunctions();
		},
		error: function(errorThrown){
			console.log("Error with list refreshing: ");
			console.log(errorThrown);
		}
	});
}





addNewToDoAJAX = function(toDoName){
	 
	// This does the ajax request
	jQuery.ajax({
		url: dataForAJAX.ajaxurl,
		data: {
			'action': 'add_new_todo_ajax_handler',
			'new_to_do_name' : toDoName,
			'nonce' : dataForAJAX.nonce
		},
		success:function(data) {
			console.log(data);
			refreshListAJAX();
		},
		error: function(errorThrown){
			console.log("Error with adding to do: ");
			console.log(errorThrown);
		}
	});  
}




deleteToDo = function(toDoID){

	jQuery.ajax({
		url: dataForAJAX.ajaxurl,
		data: {
			'action': 'delete_to_do_ajax_handler',
			'post_id_to_delete' : toDoID,
			'nonce' : dataForAJAX.nonce
		},
		success:function(data) {
			console.log(data);
			refreshListAJAX();
		},
		error: function(errorThrown){
			console.log("Error with deleting to do: ");
			console.log(errorThrown);
		}
	});
}

changeStatus = function(toDoID){

	jQuery.ajax({
		url: dataForAJAX.ajaxurl,
		data: {
			'action': 'change_status_ajax_handler',
			'to_do_id_to_change' : toDoID,
			'nonce' : dataForAJAX.nonce
		},
		success:function(data) {
			console.log(data);
			refreshListAJAX();
		},
		error: function(errorThrown){
			console.log("Error with deleting to do: ");
			console.log(errorThrown);
		}
	});
}





changeName = function(toDoID, newName){

	jQuery.ajax({
		url: dataForAJAX.ajaxurl,
		data: {
			'action': 'change_name_ajax_handler',
			'to_do_id_to_change' : toDoID,
			'to_do_name_to_change' : newName,
			'nonce' : dataForAJAX.nonce
		},
		success:function(data) {
			console.log(data);
			refreshListAJAX();
		},
		error: function(errorThrown){
			console.log("Error with deleting to do: ");
			console.log(errorThrown);
		}
	});
}
