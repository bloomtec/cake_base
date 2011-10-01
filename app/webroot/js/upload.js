$(document).ready(function() {
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

	$('#single-upload').uploadify({
		'uploader' : server + 'swf/uploadify.swf',
		'script' : server + 'uploadify.php',
		'folder' : server + 'app/webroot/img/uploads',
		'auto' : true,
		'cancelImg' : server + 'img/cancel.png',
		'onComplete' : function(a, b, c, d) {
			var oldImage = $("#single-field").val();
			$.post(server + "images/deleteImage", {
				name : oldImage
			}, function(data) {// Elimina la imagen antigua

			});
			$(".preview").html('<img  src="' + d + '" />');
			var file = d.split("/");
			var nombre = file[(file.length - 1)];
			var name = c.name;
			$("#single-field").val(nombre);
			$.post(server + "images/resizeImage", {
				name : nombre,
				folder : 'uploads'
			}, function(data) {

			});

		}
	});
});