$(document).ready(function(){
	role_id = $("#UserRoleId option:selected").attr('value');
	if(role_id == 1) {
		$(".city-id").css('visibility', 'hidden');
	} else {
		$(".city-id").css('visibility', 'visible');
	}
});
$(function(){
	$("#UserRoleId").change(
			function() {
				role_id = $("#UserRoleId option:selected").attr('value');
				if(role_id == 1) {
					$(".city-id").css('visibility', 'hidden');
				} else {
					$(".city-id").css('visibility', 'visible');
				}
			}
	);
});