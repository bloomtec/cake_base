<div class="pane" id="payfoll">
	<div class="payfoll tab" rel="payfoll">
	</div>
	<div class="body">
		<div class="content" style="width:90%;">
			<div class="container-paginado all" rel="/users/listFriends/criteria:">
					
			</div>			
		</div>
		<div style="clear:both;"></div>
		<div class="search-friends">
			<h1>Buscar</h1>
			<?php echo $form->input("email",array("label"=>"Correo Electrónico","id"=>"email"));?>
			<?php echo $form->input("nombre",array("label"=>"Nombre","id"=>"nombre"));?>
			<?php echo $form->button("buscar"); ?>
		</div>
	</div>
</div>
<script>
$(function(){
	var $container=$(".container-paginado");
	$container.load($container.attr("rel"),{},function(){
		$.each($(this).find(".paging a"),function(i,val){
			var href=$(val).attr("href");
			$(val).attr("href",href+"/criteria:")
		});				
	});
});
</script>