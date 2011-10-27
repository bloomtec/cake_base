$(function(){
	$('.limite , .orden').change(function(){
			console.log(BJS.setParam('limite',$(this).find('option:selected').val()));
	});
	
	//CARGA EL LISTADO DE FILTROS
	var divFiltro=$("#listado_fltro");
	if(divFiltro.length > 0){
		divFiltro.load('/tags/filtro/'+divFiltro.attr('rel'));
	}
});

