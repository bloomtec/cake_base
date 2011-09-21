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
	BJS.center=function(){
		var siteHeight=600;
		var windowHeight=$(window).height();
		if(windowHeight>siteHeight){
			var diferencia=windowHeight-siteHeight;
			var marginTop=diferencia/2;
			$("#container").css({"margin-top":marginTop}).fadeIn("slow");
		}
	}
	BJS.center();
	
	
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
		$(".team-lists li").removeClass("here");
		$(".menu h2").removeClass("here");
		$that.parent().addClass("here");
		if($that.parent().parent().hasClass("team-lists")){
			$(".menu-team").addClass("here");
		}
		e.preventDefault();
		$that.parents(".menu").siblings(".content").load($that.attr("href"),{},function(){
			var containerPaginado=$(this).find(".container-paginado");
			$.each(containerPaginado,function(i,val){
				// SI EL CONTENIDO TIENE ALGUN PAGINADO LO CARGA
				$(this).load($(this).attr("rel"));		
			});
			$('#uploadfy').uploadify({
				'uploader' : '/swf/uploadify.swf',
				'script' : '/uploadify.php',
				'folder' : '/app/webroot/img/uploads',
				'auto' : true,
				'cancelImg' : '/img/cancel.png',
				'onComplete' : function(a, b, c, d) {						
					$(".escudo .preview").html('<img  src="' + d + '" />');
					var file = d.split("/");
					var nombre = file[(file.length - 1)];
					$("#single-field").val(nombre);
					$.post("/images/resizeImage", {name:nombre,folder:'uploads'});

				}
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
		$that=$(this);
		var $container=$(this).parents(".container-search");
		if($container.attr("criteria")){
			var criteria=$($container.attr("criteria")).val();
		}else{
			var criteria="";
		}
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
	$(".convocar .player .add").live("click",function(e){
		e.stopPropagation()
		var $that=$(this);
		var $container=$that.parents(".container-paginado");
		var teamId=$container.attr("team");
		var playerId=$that.parent().parent().attr("rel");
		console.log(teamId);
		console.log(playerId);
		BJS.post("/usersTeams/callUsersToTeam/team_id:"+teamId+"/user_id:"+playerId,{},function(data){
			if(data){
				$that.after("<div class='convocado'> Convocado </div>");
			}
		});
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
	//FUNCIONAMIENTS ESPECIALES PAYFOLL
	var $containerPaginado=$(".container-paginado"); //PAGINADO DE LOS AMIGOS
	$containerPaginado.load($containerPaginado.attr("rel"),{},function(){
		$.each($(this).find(".paging a"),function(i,val){
			var href=$(val).attr("href");
			$(val).attr("href",href+"/criteria:")
		});				
	});
	var $containerSearch=$("#tabSearch");
	$("button#searchPlayer").live("click",function(e){
		var nombre=$("#nombre").val();
		var email=$("#email").val();
		$containerSearch.load($containerSearch.attr("rel")+"nombre:"+nombre+"/email:"+email,{},function(){
			$.each($(this).find(".paging a"),function(i,val){
				var href=$(val).attr("href");
				$(val).attr("href",href+"/nombre:"+nombre+"/email:"+email)
			});				
		});
	});
	// FUNCIONAMIENTOS ESPECIALES RETOS
	$(".add-to-match .player .add").live("click",function(e){
		e.preventDefault();
		var player=$(this).parent().parent();
		var buscar=$(".match-player").find("div[rel='"+player.attr('rel')+"']");
		if(buscar.length > 0){
			buscar.hide("fast").show("fast");
		}else{
			$(".match-player").append("\
				<div  class='player' rel='"+player.attr('rel')+"'>\
					<div class='container'>"+player.find('.name').text()+"\
					</div>\
					<div class='remove'> \
					X\
					</div>\
				<div style='clear:both;'></div>\
				</div>\
			");
			$("#create-match").append(
				"<input type='hidden' name='data[User][User]["+player.attr('rel')+"]' value='"+player.attr('rel')+"' rel='"+player.attr('rel')+"' />"
			);
		}
	});
	$(".add-to-match .player .remove").live("click",function(){
		var rel=$(this).parent().attr("rel");
		$(".match-player .player[rel='"+rel+"']").hide("fast").remove();
		$("#create-match input[rel='"+rel+"']").remove();
		
	});
	var $containerEquipos=$("#otros-equipos");
	$containerEquipos.load($containerEquipos.attr("rel"),{},function(){
		$.each($(this).find(".paging a"),function(i,val){
			var href=$(val).attr("href");
			$(val).attr("href",href+"/criteria:")
		});				
	});
	$(".show-friends").live("click",function(e){
		$(".switches div").removeClass("open");
		$(this).addClass("open");
		$(".equipos-panel").fadeOut(function(e){
			$(".friend-panel").fadeIn();
		});
	});
	$(".show-teams").live("click",function(e){
		$(".switches div").removeClass("open");
		$(this).addClass("open");
		$(".friend-panel").fadeOut(function(e){
			$(".equipos-panel").fadeIn();
		});
	});	
	$("#armar-equipo").live("click",function(e){
		var fields=$("#create-match").serialize();
		BJS.post("/matches/add",fields,function(data){
			$(".match-confirmation").html(data);
		});
	});
});