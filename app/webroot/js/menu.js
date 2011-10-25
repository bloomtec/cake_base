$(function() {
	/**
	* menu
	*/
	
	$.each($('#main_menu li ul'),function(i,val){
		$(val).parent().addClass("desplegable");
	});
	
});