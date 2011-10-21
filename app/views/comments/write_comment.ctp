<form id="CommentAddForm" class="comment-form" accept-charset="utf-8" method="post" action="/comments/add">
	<input id="CommentProductId" type="hidden" value="<?=$productId?>" name="data[Comment][product_id]">
	<textarea placeholder='Escribe aqui tu comentario' id="CommentComment" name="data[Comment][comment]" style="width: 99%; background: transparent; color: #A1A1A1;"></textarea>
	<input type='submit' class="azul tahoma enviar"  value='ENVIAR COMENTARIO' />
</form>
<script type="text/javascript">
	$("#CommentAddForm").live('submit', function(e) {
		e.preventDefault();
		var $form = $(this);
		var fields = $form.serialize();
		BJS.post($form.attr('action'), fields, function(info) {
			if(info == 1) {
				$('.enviar').after('Comentario en espera de ser aprobado');
				$('input[type=text]').val('')
				$('textarea').val('')
			} else {
				alert('no se pudo enviar el comentario');
				// lo que debe hacer si no
			}
		});
	});

</script>