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
				var list = $("#ProductSocket");
				if(data != null) {
					list.html('');
					$.each(data, function(key, value){
						list.append('<option val="' + key + '">' + value + '</option>');
					});
				} else {
					list.html('<option>Seleccione...</option>');
				}				
			}
		});
	});
});