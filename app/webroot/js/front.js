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
	
	$('.filtros select[id!="city_id"]').change(function(){
		document.location = BJS.setParam($(this).attr('rel'),$(this).val());
	});
	$('.filtros select[id="city_id"]').change(function(){
		var urlWithCity = BJS.setParam($(this).attr('rel'),$(this).val());
		document.location = BJS.removeParam('zone',urlWithCity);
	});
	$(".iniciar_sesion").toggle(
			function(e){
				e.preventDefault();
				$(".tooltip_login").slideDown(250);
			},
			function(e){
				e.preventDefault();
				$(".tooltip_login").slideUp(250);
			}
	);
	$(".ajax_login form").validator().submit(function(e){
		e.preventDefault();
		var form=$(this);
		BJS.JSONP(form.attr("action"),form.serialize(), function(user) {
			if(user.success === true){
				if(){
					
				}else{
					
				}
			}else{
				console.log('no se logueo');
			}
		});
	});
});