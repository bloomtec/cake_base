$(function(){
	BJS = {};

	BJS.get = function(url, params, callback) {
		jQuery.ajax({
			url : url,
			type : "GET",
			cache : false,
			data : params,
			success : callback
		});
	}
	BJS.getS = function(url, params, callback) {
		jQuery.ajax({
			url : url,
			type : "GET",
			cache : false,
			data : params,
			async : false,
			success : callback
		});
	}

	BJS.post = function(url, params, callback) {
		jQuery.ajax({
			url : url,
			type : "POST",
			cache : false,
			data : params,
			success : callback
		});
	}

	BJS.JSON = function(url, params, callback) {
		jQuery.ajax({
			url : url,
			type : "GET",
			cache : false,
			dataType : "json",
			data : params,
			success : callback
		});
	}

	BJS.JSONP = function(url, params, callback) {
		jQuery.ajax({
			url : url,
			type : "POST",
			cache : false,
			dataType : "json",
			data : params,
			success : callback
		});
	}
	BJS.setParam = function(param, value) {
		/* añande o modifica un parametro de la forma param:value */
		var url = document.URL;
		var params = url.substring(url.indexOf("/", 0));
		if (params.substring(0, 2) == "//") {
			params = params.substring(params.indexOf("/", 2));
		}
		if (params.slice(-1) != "/") {
			params += "/";
		}
		paramInUrl = params.indexOf(param + ":");// desde donde esta el
		// parametro
		if (paramInUrl >= 0) {
			var indexValue = paramInUrl + param.length + 1/*
															 * incluyo los dos
															 * puntos
															 */;
			var urlTillValue = params.substring(0, indexValue);
			var newValue = params.substring(indexValue, params.indexOf("/",
					paramInUrl));
			var urlAfterValue = params.substring(indexValue + newValue.length);
			return urlTillValue + value + urlAfterValue;
		} else {
			return params + param + ":" + value;
		}
	}
	
	//COMENTARIOS__________________
	$("#CommentForm").submit(function(e){
			e.preventDefault();
			var $form = $(this);
			BJS.post("/comments/add",$form.serialize(),function(created){
				if(created){
					$commentList = $(".comments-list");
					if($(".comments-list .comment").length){
						$commentList.prepend("\
						<div class='comentario_usuario comment ajax'>\
							<div class='usuario'>\
						 		<h1>Tu Comentario</h1>\
							</div>\
							<div class='comentario'>\
								<p>"+$('#CommentComment').val()+"</p>\
							</div>\
							<div style='clear:both;'></div>\
						</div>\
						");	
					}else{
						//$commentList.html();	
					}
					$("#CommentForm").append("<div class='message success'> su comentario ha sido añadido </dov>");	
					setTimeout(function(){
						$("#CommentForm div.message").hide().remove();
						$(".comment.ajax").removeClass("ajax");
					},2000);
				}
			});
	});
	$("a.delete-comment").live("click",function(e){
		var rel=$(this).attr('rel');
		e.preventDefault();
		BJS.get("/comments/delete/"+rel,{},function(data){
			if(data){
				$('div.comment[rel="'+rel+'"]').remove();
			}
		});
	});
	// VOTOS GENERALES
	$(function(){
		var estrellas = {}
		var initVote = function(modelRel,average){
			var num = average.split('.');
			var i=0;
			for( ; i < num[0]; i += 1){
			estrellas[modelRel][i]= {'element':$('div[rel="'+modelRel+'"] div.start[rel="'+i+'"]'),'first-class':'start start-4','actual-class':'start start-4'};
				$('div[rel="'+modelRel+'"] div.start[rel="'+i+'"]').attr('class','start start-4');
			}
			
			if(num.length == 2){
				estrellas[modelRel][i]= {'element':$('div[rel="'+modelRel+'"] div.start[rel="'+i+'"]'),'first-class':'start start-2','actual-class':'start start-2'};
				$('div[rel="'+modelRel+'"] div.start[rel="'+i+'"]').attr('class','start start-2');
				i += 1;
			}
			for( ; i < 5; i += 1){
				estrellas[modelRel][i]= {'element':$('div[rel="'+modelRel+'"] div.start[rel="'+i+'"]'),'first-class':'start start-0','actual-class':'start start-0'};
				$('div[rel="'+modelRel+'"] div.start[rel="'+i+'"]').attr('class','start start-0');
			}
		}
		$.each($('.vote.active'),function(i,val){
			//console.log('invocado');
			BJS.post('/polls/getPolls/'+$(val).attr('rel'),{},function(data){
				var rel = $(val).attr('rel');
				estrellas[rel]={};
				initVote(rel,data);
			});
		});
		$('.active .start').mouseenter(function(){
			var modelRel = $(this).parent().attr('rel');
			var $that = $(this);
			var thatRel = $that.attr('rel');
			$.each(estrellas[modelRel],function(i,val){
				if(thatRel >= val['element'].attr('rel')){
					val['element'].removeClass('start-0 start-1 start-2 start-3').addClass('start-4');
					val['actual-class'] = 'start-5';
				}else{
					val['element'].removeClass('start-0 start-1 start-2 start-3 start-4').addClass('start-0');
					val['actual-class'] = 'start-0';
				}
			});
			/* $(this).removeClass('start-0 start-1 start-2 start-3 start-4').addClass('start-5');
			$(this).prevAll().removeClass('start-0 start-1 start-2 start-3 start-4').addClass('start-5');
			estrellas[$(this).attr('rel')]['actual-class']='start-5'; */
		});
		$('.active.vote').mouseout(function(){
			var modelRel = $(this).attr('rel');
			$.each(estrellas[modelRel],function(i,val){
				val['element'].removeClass('start-0 start-1 start-2 start-3 start-4').addClass(val['first-class']);
				val['actual-class'] = val['first-class'];
			});
		});
		$('.active .start').click(function(){
			var modelRel = $(this).parent().attr('rel');
			$('div[rel="'+modelRel+'"] .poll.message').fadeIn();
			BJS.post('/polls/add/'+modelRel+ '/' + (parseInt($(this).attr('rel')) + 1),{},function(average){
			if(average){ 
				initVote(modelRel,average);
				$('div[rel="'+modelRel+'"] .poll.message').fadeOut();
			};
		});
		});
	})
});
