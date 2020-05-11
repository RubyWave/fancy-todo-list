
function assingButtonFunctions() {
	
	
	
	jQuery( ".new-todo-name" ).on('keypress',function(e) {
		if(e.which == 13) {
			let toDoName = jQuery(".new-todo-name").val();
			if( toDoName ) {
				addNewToDoAJAX( toDoName );
			}
		}
	});
	
	
	
	jQuery( ".todo-title" ).on('keypress',function(e) {
		if(e.which == 13) {
			event.preventDefault();
			let toDoName = jQuery( this ).val();
			let toDoID = jQuery( this ).parent().data('post-id');
			if( toDoName && toDoID ) {
				toDoName = toDoName.replace(/(\r\n|\n|\r)/gm, "");
				changeName(jQuery( this ).parent().data('post-id'), toDoName);
			}
		}
	});
	

	jQuery(".add-new-todo").click(function() {
		let toDoName = jQuery(".new-todo-name").val();
		if( toDoName ) {
			addNewToDoAJAX( toDoName );
		}
	});
	
	jQuery(".delete-this").click(function() {
		let toDoID = jQuery( this ).parent().data('post-id');
		if( toDoID ) {
			deleteToDo( toDoID );
		}
	});
	
	jQuery(".checkbox-wrapper").click(function() {
		let toDoID = jQuery( this ).parent().data('post-id');
		if( toDoID ) {
			changeStatus( toDoID );
		}
	});
}
assingButtonFunctions();
	


