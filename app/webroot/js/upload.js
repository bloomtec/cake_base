$(document).ready(function() {
			$('#upload').uploadify({
				'uploader' : '/swf/uploadify.swf',
				'script' : '/uploadify.php',
				'folder' : '/app/webroot/img/uploads',
				'auto' : true,
				'cancelImg' : '/img/cancel.png',
				'onComplete' : function(a, b, c, d) {
				}
			});

			$('#single-upload').uploadify({
				'uploader' : '/swf/uploadify.swf',
				'script' : '/uploadify.php',
				'folder' : '/app/webroot/img/uploads',
				'auto' : true,
				'cancelImg' : '/img/cancel.png',
				'onComplete' : function(a, b, c, d) {
					var oldImage=$("#single-field").val();
					$.post("/images/deleteImage", {name:oldImage}, function(data){//Elimina la imagen antigua
						
					});							
					$(".preview").html('<img  src="' + d + '" />');
					var file = d.split("/");
					var nombre = file[(file.length - 1)];
					var name = c.name;
					$("#single-field").val(nombre);
						$.post("/images/resizeImage", {name:nombre,folder:'uploads'}, function(data){
					
						});
					}
			});
			$('#pictures-uploader').uploadify({
				'uploader' :'/swf/uploadify.swf',
				'script' : '/uploadify.php',
				'cancelImg' : '/app/webroot/img',
				'folder' : '/app/webroot/img/uploads',
				'multi' : true,
				'auto' : true,
				'fileExt' : '*.jpg;*.gif;*.png;*.PNG;*.JPG;*.GIF;*jpeg;*JPEG',
				'fileDesc' : 'Image Files (.JPG, .GIF, .PNG, .JPEG)',
				'queueSizeLimit' : 10,
				'simUploadLimit' : 10,
				'removeCompleted' : false,
				'onSelectOnce' : function(event, data) {
					$('#status-message').text(data.filesSelected+ ' files have been added to the queue.');
				},
				'onComplete' : function(a, b, c, d) {
					var file = d.split("/");
					var nombre = file[(file.length - 1)];
					var parentId=$('#pictures-uploader').attr("rel");
					var controller=$('#pictures-uploader').attr("controller");
					$.post("/images/resizeImage", {name:nombre,folder:'pictures'}, function(data){
			
					});
					$.post("/"+controller+"/uploadfy_add", {'name' : nombre,'folder' : "uploads",'parent_id' : parentId}, function(data) {
						$(".pictures").append('\
										<div class="image-container">\
										<div class="image"><img alt="" src="/img/uploads/'+nombre+'"></div>\
										<div class="actions">\
										<a onclick="return confirm(\'Are you sure you want to delete # 1?\');" href="/admin/'+controller+'/delete/'+data+'">Borrar</a></div>\
										</div>\
										');
					});

				},
				'onAllComplete' : function(event, data) {
					$('#status-message').text(data.filesUploaded+ ' files uploaded, '+ data.errors+ ' errors.');
				}
			});

		$('ul.galeria li').click(function() {
				$('ul.galeria li').removeClass('selected');
				$(this).addClass("selected");
		});	
});