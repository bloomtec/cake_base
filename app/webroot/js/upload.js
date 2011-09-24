$(document).ready(
		function() {
			var server = '/';

			$('#upload').uploadify({
				'uploader' : server + 'swf/uploadify.swf',
				'script' : server + 'uploadify.php',
				'folder' : server + 'app/webroot/img/uploads',
				'auto' : true,
				'cancelImg' : server + 'img/cancel.png',
				'onComplete' : function(a, b, c, d) {
				}
			});

			$('#single-upload').uploadify(
					{
						'uploader' : server + 'swf/uploadify.swf',
						'script' : server + 'uploadify.php',
						'folder' : server + 'app/webroot/img/uploads',
						'auto' : true,
						'cancelImg' : server + 'img/cancel.png',
						'onComplete' : function(a, b, c, d) {
							var oldImage=$("#single-field").val();
							$.post(server + "images/deleteImage", {name:oldImage}, function(data){//Elimina la imagen antigua
								
							});							
							$(".preview").html('<img  src="' + d + '" />');
							var file = d.split("/");
							var nombre = file[(file.length - 1)];
							var name = c.name;
							$("#single-field").val(nombre);
							$.post(server + "images/resizeImage", {name:nombre,folder:'uploads'}, function(data){
							
							});

						}
			});
			$('#multiple-upload').uploadify({
				'uploader' :'/swf/uploadify.swf',
				'script' : '/uploadify.php',
				'cancelImg' : '/app/webroot/img',
				'folder' : '/app/webroot/img/uploads',
				'multi' : true,
				'auto' : true,
				'fileExt' : '*.jpg;*.gif;*.png;*.PNG;*.JPG;*.GIF',
				'fileDesc' : 'Image Files (.JPG, .GIF, .PNG)',
				'queueSizeLimit' : 10,
				'simUploadLimit' : 10,
				'removeCompleted' : false,
				'onSelectOnce' : function(event, data) {
					$('#status-message').text(data.filesSelected+ ' files have been added to the queue.');
				},
				'onComplete' : function(a, b, c, d) {
					var file = d.split("/");
					var nombre = file[(file.length - 1)];
					var galleryId=$('#multiple-upload').attr("rel");
					console.log(galleryId);
					$.post("/pictures/uploadfy_add", {'name' : nombre,'folder' : "uploads",'galleryId' : galleryId}, function(data) {
						$(".pictures").append('\
										<div class="image-container">\
										<div class="image"><img alt="" src="/img/uploads/200x200/'+nombre+'"></div>\
										<div class="actions">\
										<a onclick="return confirm(\'Are you sure you want to delete # 1?\');" href="/admin/pictures/delete/'+data+'">Borrar</a>			</div>\
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
			
			//*GALERIAs DE PAGINADA*/
			$('#uploadfy1').uploadify(
					{
						'uploader' : server + 'swf/uploadify.swf',
						'script' : server + 'uploadify.php',
						'folder' : server + 'app/webroot/img/uploads',
						'auto' : true,
						'cancelImg' : server + 'img/cancel.png',
						'onComplete' : function(a, b, c, d) {
							var oldImage=$("#PagePic1").val();
							$.post(server + "images/deleteImage", {name:oldImage}, function(data){//Elimina la imagen antigua
								
							});							
							$(".pic1 .preview").html('<img  src="' + d + '" />');
							var file = d.split("/");
							var nombre = file[(file.length - 1)];
							var name = c.name;
							$("#PagePic1").val(nombre);
							$.post(server + "images/resizeImage", {name:nombre,folder:'uploads'}, function(data){
							
							});

						}
			});
			$('#uploadfy2').uploadify(
					{
						'uploader' : server + 'swf/uploadify.swf',
						'script' : server + 'uploadify.php',
						'folder' : server + 'app/webroot/img/uploads',
						'auto' : true,
						'cancelImg' : server + 'img/cancel.png',
						'onComplete' : function(a, b, c, d) {
							var oldImage=$("#PagePic2").val();
							$.post(server + "images/deleteImage", {name:oldImage}, function(data){//Elimina la imagen antigua
								
							});							
							$(".pic2 .preview").html('<img  src="' + d + '" />');
							var file = d.split("/");
							var nombre = file[(file.length - 1)];
							var name = c.name;
							$("#PagePic2").val(nombre);
							$.post(server + "images/resizeImage", {name:nombre,folder:'uploads'}, function(data){
							
							});

						}
			});			
			$('#uploadfy3').uploadify(
					{
						'uploader' : server + 'swf/uploadify.swf',
						'script' : server + 'uploadify.php',
						'folder' : server + 'app/webroot/img/uploads',
						'auto' : true,
						'cancelImg' : server + 'img/cancel.png',
						'onComplete' : function(a, b, c, d) {
							var oldImage=$("#PagePic3").val();
							$.post(server + "images/deleteImage", {name:oldImage}, function(data){//Elimina la imagen antigua
								
							});							
							$(".pic3 .preview").html('<img  src="' + d + '" />');
							var file = d.split("/");
							var nombre = file[(file.length - 1)];
							var name = c.name;
							$("#PagePic3").val(nombre);
							$.post(server + "images/resizeImage", {name:nombre,folder:'uploads'}, function(data){
							
							});

						}
			});
			$('#uploadfy4').uploadify(
					{
						'uploader' : server + 'swf/uploadify.swf',
						'script' : server + 'uploadify.php',
						'folder' : server + 'app/webroot/img/uploads',
						'auto' : true,
						'cancelImg' : server + 'img/cancel.png',
						'onComplete' : function(a, b, c, d) {
							var oldImage=$("#PagePic4").val();
							$.post(server + "images/deleteImage", {name:oldImage}, function(data){//Elimina la imagen antigua
								
							});							
							$(".pic4 .preview").html('<img  src="' + d + '" />');
							var file = d.split("/");
							var nombre = file[(file.length - 1)];
							var name = c.name;
							$("#PagePic4").val(nombre);
							$.post(server + "images/resizeImage", {name:nombre,folder:'uploads'}, function(data){
							
							});

						}
			});
});