$(document).ready(function () {
	var selected = $("#ProductProductTypeId option:selected").val();
	if(typeof(selected) != "undefined" && selected !=null && selected.length > 0) {
		var prod_id = $("#product-id").attr('rel');
		$("#ProductProductTypeInfo").load("/admin/products/formByType/" + selected + "/" + prod_id,function(){
			if(selected == 1 || selected == 2) {
				var arch = $("#ProductArchitectureId option:selected").val();
				jQuery.ajax({
					url : "/products/getSocketsByArchitecture/" + arch,
					type : "GET",
					cache : false,
					dataType : "json",
					data : null,
					success : function(data) {
						if(data != null) {
							$("#sockets").html('');
							$("#sockets").append('<fieldset id="socket-list"><legend>Socket</legend>');
							$("#socket-list").append('<input id="SocketSocket_" type="hidden" value="" name="data[Socket][Socket]">');
							$.each(data, function(key, value){
								$("#socket-list").append('<input id="SocketSocket' + key + '" type="radio" value="' + key + '" name="data[Socket][Socket][]">');
								$("#socket-list").append('<label for="SocketSocket' + key + '">' + value + '</label>');
							});
							$("#sockets").append('</fieldset>');
							var prod_id = $('#sock_id').attr('rel');
							$('#SocketSocket' + prod_id).attr('checked', true);
						} else {
							$("#sockets").html('');
						}
					}
				});
			}
		});
		
	}
});

$(function() {
	/**
	 * Cargar el contenido adecuado para cuando se
	 * agrega un producto.
	 */
	$("#ProductProductTypeId").change(function(select) {
		var selected = $("#ProductProductTypeId option:selected").val();
		$("#ProductProductTypeInfo").load("/admin/products/formByType/" + selected);
	});
	/**
	 * Cargar el contenido de sockets acorde la
	 * arquitectura seleccionada.
	 */
	$("#ProductArchitectureId").live('change', function(select) {
		var selected = $("#ProductArchitectureId option:selected").val();
		jQuery.ajax({
			url : "/products/getSocketsByArchitecture/" + selected,
			type : "GET",
			cache : false,
			dataType : "json",
			data : null,
			success : function(data) {
				if(data != null) {
					$("#sockets").html('');
					$("#sockets").append('<fieldset id="socket-list"><legend>Socket</legend>');
					$("#socket-list").append('<input id="SocketSocket_" type="hidden" value="" name="data[Socket][Socket]">');
					$.each(data, function(key, value){
						$("#socket-list").append('<input id="SocketSocket' + key + '" type="radio" value="' + key + '" name="data[Socket][Socket][]">');
						$("#socket-list").append('<label for="SocketSocket' + key + '">' + value + '</label>');
					});
					$("#sockets").append('</fieldset>');
				} else {
					$("#sockets").html('');
				}
			}
		});
	});
});