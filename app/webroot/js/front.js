$(function(){
	BJS={};
	BJS.setParam = function(param,value){
		/*añande o modifica un parametro de la forma param:value*/
		var url = document.URL;
		var params=url.substring(url.indexOf("/",0));
		if(params.substring(0,2)=="//"){
			params=params.substring(params.indexOf("/",2));
		}
		if(params.slice(-1) != "/"){
			params+="/";
		}
		paramInUrl=params.indexOf(param+":");//desde donde esta el parametro
		if(paramInUrl>=0){
			var indexValue= paramInUrl + param.length + 1/*incluyo los dos puntos*/;
			var urlTillValue=params.substring(0,indexValue);
			var newValue=params.substring( indexValue, params.indexOf( "/" , paramInUrl ) );
			var urlAfterValue=params.substring(indexValue + newValue.length);  
			return	urlTillValue+value+urlAfterValue;	
		}else{
			return	params+param+":"+value;
		}
	}
//CLASES DE LAS FUENTES
Cufon.replace('.japan', { fontFamily: 'Japan', 	trim:"simple" });
Cufon.replace('.twCenMt', { fontFamily: 'TwCenMt', 	trim:"simple" }); 
Cufon.replace('.halo', { fontFamily: 'HaloHandLetter', 	trim:"simple" });


//EFECTO HOVER DE LAS MARCAS
	$(".brands-menu li a img").hover(
		function(){
			$(this).attr("src","/img/uploads/"+$(this).attr("rel"));
		},
		function(){
			$(this).attr("src","/img/uploads/"+$(this).attr("image"));
		}
	);
	$("select.filter").change(function(){
		document.location.href=BJS.setParam( $(this).attr('rel') , $(this).find("option:selected").val() );
	});
	$('a.order').click(function(e){
		e.preventDefault();
		document.location.href=BJS.setParam( 'orden' , $(this).attr('rel') );
		
	});
	
	//OVERLAY
	$("#footer a[rel]").overlay({
		mask: 'black',
		onBeforeLoad: function() {
			var wrap = this.getOverlay().find(".contentWrap");
			wrap.load(this.getTrigger().attr("href"));
		}
	});
});
