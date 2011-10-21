<p class="titulos_rosado tahoma">Déjanos saber lo que piensas de esta prenda. Puedes escribir también como la combinarías 
o para qué situación la usarías.Gracias!</p>
<form id="CommentAddForm" class="comment-form tahoma" accept-charset="utf-8" method="post" action="/comments/add">
	<input id="CommentProductId" type="hidden" value="<?=$productId?>" name="data[Comment][product_id]">
	<label class="azul">COMENTARIO</label>
	<textarea placeholder='Escribe aqui tu comentario' id="CommentComment" name="data[Comment][comment]" class="comentario"></textarea>
	<input type='submit' class="input_verde"  value='Enviar Comentario' />
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
		Cufon.replace('.tahoma', {
		fontFamily : 'Tahoma',
		trim : "simple",
		hoverables:{a:true},
		hover:{color:'#ffaedc'}

	});
	Cufon.replace('.japan', {
		fontFamily : 'Japan',
		trim : "simple"
	});

	Cufon.replace('.twCenMt', {
		fontFamily : 'TwCenMt',
		trim : "simple",
		hoverables:{a:true},
		hover:{color:'#00CFB5'}
	});
	
	Cufon.replace('.halo', {
		fontFamily : 'HaloHandLetter',
		trim : "simple"
	});	
</script>