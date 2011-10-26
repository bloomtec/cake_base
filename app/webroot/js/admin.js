$(function() {
	/**
	 * Cargar el contenido adecuado para cuando se
	 * agrega un producto.
	 */
	$("#ProductProductTypeId").change(
			function(select) {
				var selected = parseInt($(
						"#ProductProductTypeId option:selected").val());
				switch (selected) {
				case 1:
					console.log("Procesador");
					$("#ProductProductTypeInfo").append("Procesador");
					break;
				case 2:
					console.log("Tarjeta Madre");
					break;
				case 3:
					console.log("Memoria");
					break;
				case 4:
					console.log("Disco Duro");
					break;
				case 5:
					console.log("Tarjeta De Video");
					break;
				case 6:
					console.log("Tarjeta De Sonido");
					break;
				case 7:
					console.log("Torre");
					break;
				case 8:
					console.log("Impresora");
					break;
				case 9:
					console.log("Monitor");
					break;
				case 10:
					console.log("Otras Tarjetas");
					break;
				case 11:
					console.log("Accesorios");
					break;
				case 12:
					console.log("Memoria USB");
					break;
				case 13:
					console.log("Otro");
					break;
				default:
					break;
				}
			});
});