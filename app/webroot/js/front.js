$(function(){
	$('.limite ').change(function(){
			console.log(BJS.setParam('limite',$(this).find('option:selected').val()));
	});
	$('.orden').change(function(){
			console.log(BJS.setParam('orden',$(this).find('option:selected').val()));
	});
	
	//CARGA EL LISTADO DE FILTROS
	var divFiltro=$("#listado_fltro");
	if(divFiltro.length > 0){
		divFiltro.load('/tags/filtro/'+divFiltro.attr('rel'));
	}
	
	//CARGA EL PRODUCTO PROMOCIONADO
	var divPromocionado=$("#producto_destacado");
	if(divPromocionado.length > 0){
		divPromocionado.load('/products/featuredProduct/'+divPromocionado.attr('rel'));
	}
	
	
	//CARRITO
	
	
	//Recordar contraseña
	$("#rememberForm").live('submit',function(e){
		e.preventDefault();
		var fields=$(this).serialize();
		BJS.post('/users/rememberPassword',fields,function(response){
			if(response){
				$('.confirmacion-remember').show();
			}else{
				$('.confirmacion-remember').html('no se pudo realizar tu solicitud verifica tu email').show();
			}
		})
	});
	
	
	//VALIDACION DE FORMULARIOS
	$.tools.validator.fn("[data-equals]", "el campo no es igual", function(input) {
		var name = input.attr("data-equals"),
		 field = this.getInputs().filter("[name=" + name + "]");
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
	
	$('form').validator({lang:'es'});
});

