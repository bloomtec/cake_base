$(function(){
	$.tools.validator.fn("[data-equals]", "el campo no es igual", function(input) {
		var name = input.attr("data-equals"),
		 field = this.getInputs().filter("[name='" + name + "']");
		return input.val() == field.val() ? true : [name]; 
	});
	
	$.tools.validator.localize("es", {
		'*'			: 'dato no valido',
		':email'  	: 'email no valido',
		':number' 	: 'el campo debe ser numerico',
		':url' 		: 'URL no valida',
		'[max]'	 	: 'el campo debe ser menor a $1',
		'[min]'		: 'el campo debe ser mayot a $1',
		'[required]'	: 'campo obligatorio',
		'[data-equals]' : 'verifique este campo'
	});
});