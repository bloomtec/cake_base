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
	
});