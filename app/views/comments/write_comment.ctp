<form id="CommentAddForm" class="comment-form" accept-charset="utf-8" method="post" action="/comments/add">
	<input id="CommentProductId" type="hidden" value="<?=$productId?>" name="data[Comment][product_id]">
	<textarea placeholder='Escribe aqui tu comentario' id="CommentComment" name="data[Comment][comment]" style="width: 99%; background: transparent; color: #A1A1A1;"></textarea>
	<div id="create-comment" style='margin-top: 5px;'>
			<a id="crear-comentario" class="azul tahoma" href="/comments/add">ENVIAR COMENTARIO</a>
	</div>

</form>