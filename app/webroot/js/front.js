$(function(){
	var BJS={};
	BJS.get = function(url,params,callback){
		jQuery.ajax({
			url:url,
			type: "GET",
			cache: false,
			dataType:"json",
			data: params,
			success: callback
		});
	}
	BJS.post = function (url,params,callbak){
		jQuery.ajax({
			url:url,
			type: "POST",
			cache: false,
			dataType:"json",
			data: params,
			success: callback
		});
	}
	BJS.JSON = function (url,params,callbak){
		jQuery.ajax({
			url:url,
			type: "GET",
			cache: false,
			dataType:"json",
			data: params,
			success: callback
		});
	}
	
	
	
	$(".pane .tab").click(function(e){//ANIMACION PESTAÑAS
		var $open=$("div.open");
		var $that=$(this);
		if($that.hasClass("open")){ // si esta abierto lo cierra
			$that.parent().animate({"left":0},"fast","swing",function(){
			$that.removeClass("open");
			});
		}else{
			if($open.length){// funcionalidad por defecto
				$open.parent().animate({"left":0},"fast","swing",function(){ // cierra el que esta abierto
					$(".open").removeClass("open");
					$that.addClass("open");
					$that.parent().animate({"left":"-870"},1000,"swing",function(){// abre el cerrado
						
					});
				});
			}else{
				$that.addClass("open");
				$that.parent().animate({"left":"-870"},1000,"swing",function(){
					
				});	
			}			
		}
		
				
	});
	$(".closeTab").click(function(e){
		e.stopPropagation();
		$(this).parent().parent().animate({"left":0},"fast","swing",function(){

			});
	});
	$("a.load").click(function(e){
		
	});
	$("a.delete").click(function(e){
		e.preventDefault();
		var $that=$(this);
		var url=$that.attr("href");
		BJS.get(url,null,function(data){
			if(data){
				$that.parent().remove();
			}
		});
		
	});
	//REGISTRO
	$(".single .check").live("click",function(e){
		$that=$(this);
		$that.siblings(".check").removeClass("checked").addClass("no-checked");
		$that.addClass("checked");
		$("#"+$that.attr("rel")).val($that.attr("value"))
	});
	$(".liga").change(function(){
		var $that=$(this);
		$("#"+($that.attr("id").replace("League", "Club"))).load("/leagues/getClubsInOption/"+$that.children("option:selected").val());
		
	});
	// FUNCIONAMIENTO GENERAL
	$(".menu a.load").click(function(e){
	// CUANDO SE LE DA CLICK A UNA a.load EN EL MENU DE LA IZQUIERDA
	// CARGA LA PAGINA AL LADO DERECHO
		var $that=$(this);
		e.preventDefault();
		$that.parents(".menu").siblings(".content").load($that.attr("href"),{},function(){
			var containerPaginado=$(this).children(".container-paginado");
			$.each(containerPaginado,function(i,val){
				// SI EL CONTENIDO TIENE ALGUN PAGINADO LO CARGA
				$(this).load($(this).attr("rel"));		
			});
		});		
	});
	$(".container-paginado .paging a").live("click",function(e){
		// CARGA EL PAGINADO EN SU CONTENEDOR
		e.preventDefault();
		$that=$(this);
		$that.parents(".container-paginado").load($that.attr("href"));
	});
	$("a.overlay").live("click",function(e){
		// CARGA UN OVERLAY CON EL CONTENIDO DE LA PAGINA
		e.preventDefault();
		var $that=$(this);
		var overlay=$("#overlay");
		var wrap = overlay.find(".contentWrap");
		wrap.load($that.attr("href"));
		overlay.show();
		
	});
	$("#overlay a.close").live("click",function(e){
		e.preventDefault();
		$("#overlay").hide();
	});
});