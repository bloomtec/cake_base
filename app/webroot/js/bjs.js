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
	
});
