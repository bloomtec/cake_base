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

	$(".second_nav li a img").hover(
		function(){
			$(this).attr("src","/img/uploads/"+$(this).attr("rel"));
		},
		function(){
			$(this).attr("src","/img/uploads/"+$(this).attr("image"));
		}
	);
	$("select.filter").change(function(){
		console.log( BJS.setParam( $(this).attr('rel') , $(this).find("option:selected").val() ) );
	});
});
