$(document).ready(function () {
	var selected = $("#ProductProductTypeId option:selected").val();
	if(selected.length > 0) {
		$("#ProductProductTypeInfo").load("/admin/products/formByType/" + selected);
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
					$("#sockets").append('<input id="SocketSocket" type="hidden" value="" name="data[Socket][Socket]">');
					$.each(data, function(key, value){
						$("#socket-list").append('<input id="SlotSlot' + key + '" type="radio" value="' + key + '" name="data[Slot][Slot][]">');
						$("#socket-list").append('<label for="SlotSlot' + key + '">' + value + '</label>');
					});
					$("#sockets").append('</fieldset>');
				} else {
					$("#sockets").html('');
				}
			}
		});
	});
});