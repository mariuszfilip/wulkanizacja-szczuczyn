function show_debug(status){
	new jQuery.post('ajax.php?show_debug='+status);
}