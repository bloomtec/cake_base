$(function() {
	/**
	 * Cargar el contenido adecuado para cuando se
	 * agrega un producto.
	 */
	$("#ProductProductTypeId").change(function(select) {
		var selected = $("#ProductProductTypeId option:selected").val();
		$("#ProductProductTypeInfo").load("/admin/products/formByType/"+selected);
	});
});