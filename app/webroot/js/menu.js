$(function() {
	/**
	 * menu
	 */
	$('#main_menu ul').hide();
	$.each($('#main_menu ul'), function(i, val) {
		$(val).siblings("a").addClass("down");
	});
	$('#main_menu > li').hover(function(e) {
		e.stopPropagation();
		$(this).find("ul").slideDown();
	}, function(e) {
		e.stopPropagation();
		$(this).find("ul").slideUp();
	});
});