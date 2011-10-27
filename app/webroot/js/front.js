$(function(){
	$('.limite , .orden').change(function(){
			console.log(BJS.setParam('limite',$(this).find('option:selected').val()));
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
});

