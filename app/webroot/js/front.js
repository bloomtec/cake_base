$(function(){
	var BJS={};
	BJS.get = function(url,params,callback){
		jQuery.ajax({
			url:url,
			type: "GET",
			cache: false,
			data: params,
			success: callback
		});
	}
	BJS.post = function (url,params,callback){
		jQuery.ajax({
			url:url,
			type: "POST",
			cache: false,
			data: params,
			success: callback
		});
	}
	BJS.JSON = function (url,params,callback){
		jQuery.ajax({
			url:url,
			type: "GET",
			cache: false,
			dataType:"json",
			data: params,
			success: callback
		});
	}
	
	
	
	$(".pane .tab").click(function(e){//ANIMACION PESTA�AS
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
			var containerPaginado=$(this).find(".container-paginado");
			$.each(containerPaginado,function(i,val){
				// SI EL CONTENIDO TIENE ALGUN PAGINADO LO CARGA
				$(this).load($(this).attr("rel"));		
			});
		});		
	});
	$(".container-paginado .paging-list a").live("click",function(e){
		// CARGA EL PAGINADO EN SU CONTENEDOR
		e.preventDefault();
		$that=$(this);
		$that.parents(".container-paginado").load($that.attr("href"));
	});
	$("button").live("click",function(e){
		// envia el criterio de busqueda a la función
		var $container=$(this).siblings(".container-search");
		var criteria=$($container.attr("criteria")).val();
		$(".container-search").load($container.attr("rel")+"criteria:"+criteria,{},function(){
			//aumentar criteria a todos los a pagin 
			$.each($(this).find(".paging a"),function(i,val){
				var href=$(val).attr("href");
				$(val).attr("href",href+"/criteria:"+criteria)
			});			
		});
		
	});
	$(".container-search .paging-search a").live("click",function(e){
		// CARGA EL PAGINADO EN SU CONTENEDOR busqueda
		e.preventDefault();
		console.log("entro");
		$that=$(this);
		var $container=$(this).parents(".container-search");
		var criteria=$($container.attr("criteria")).val();
		console.log($container);
		console.log(criteria);
		$that.parents(".container-search").load($that.attr("href"),{},function(){
			$.each($(this).find(".paging a"),function(i,val){
				var href=$(val).attr("href");
				console.log(val);
				console.log(href);
				$(val).attr("href",href+"/criteria:"+criteria)
			});				
		});
	});
	//EMVIO DE FORMULARIOS
	$(".content form").live("submit",function(e){
		e.preventDefault();
		var form=$(this);
		 var fields=$(this).serialize();
		 var data={}
		 BJS.post(form.attr("action"),fields,function(data){
		 	$(".respuesta").load(data);
		 });
	});
	//OVERLAY	
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
	
	//FUNCIONAMIENTOS ESPECIALES EQUIPOS
	$(".add-to-team .player .add").live("click",function(e){
		e.preventDefault();
		var player=$(this).parent().parent();
		var buscar=$(".payroll-control").find("div[rel='"+player.attr('rel')+"']");
		if(buscar.length > 0){
			buscar.hide("fast").show("fast");
		}else{
			$(".payroll-control").append("\
				<div  class='player' rel='"+player.attr('rel')+"'>\
					<div class='container'>"+player.find('.name').text()+"\
					</div>\
					<div class='remove'> \
					X\
					</div>\
				<div style='clear:both;'></div>\
				</div>\
			");
			$("#create-team").append(
				"<input type='hidden' name='data[User][User]["+player.attr('rel')+"]' value='"+player.attr('rel')+"' rel='"+player.attr('rel')+"' />"
			);
		}
	});
	$(".payroll-control .player .remove").live("click",function(){
		var rel=$(this).parent().attr("rel");
		$(".payroll-control .player[rel='"+rel+"']").hide("fast").remove();
		$("#create-team input[rel='"+rel+"']").remove();
		
	});
	$(".team-create button").live("click",function(){
		var idForm=$(this).attr("rel");
		$("form"+idForm).submit();
	});
	$(".team-create button").live("click",function(){
		var idForm=$(this).attr("rel");
		var form=$("form"+idForm);
		/*VALIDAR NOMBRE*/
		if(form.find("input[value='']")){
			$(".mensaje-error").html("Todos lo campos son obligatorios");
			setTimeout(function(){
				$(".mensaje-error").html("");
			},1000);
		}else{
			//MENSAJE DE ERROR
			$("form"+idForm).submit();
		}
		
	});
	$("#overlay form").live("submit",function(e){
		e.preventDefault();
		var form=$(this);
		var fields=$(this).serialize();
		BJS.post(form.attr("action"),fields,function(data){
		 	$(".respuesta").html(data);
		 });
	});
	
	$("#payfoll").animate({"left":"-870"},1000,"swing");
});