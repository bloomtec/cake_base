<div class="pane" id="payfoll">
	<div class="payfoll tab" rel="payfoll">
	</div>
	<div class="body">
		<div class="content" style="width:90%;">
			<div class="container-paginado friends" rel="/users/listFriends/criteria:">
					
			</div>
			<div class="container-search all" rel="/users/search/nombre:/email/">
					
			</div>				
		</div>
		<div style="clear:both;"></div>
		<div class="search-friends">
			<h1>Buscar</h1>
			<?php echo $form->input("email",array("label"=>"Correo Electrónico","id"=>"email"));?>
			<?php echo $form->input("nombre",array("label"=>"Nombre","id"=>"nombre"));?>
			<?php echo $form->button("buscar",array("id"=>"searchPlayer")); ?>
		</div>
	</div>
</div>
<script>
$(function(){
	var $containerPaginado=$(".container-paginado");
	$containerPaginado.load($containerPaginado.attr("rel"),{},function(){
		$.each($(this).find(".paging a"),function(i,val){
			var href=$(val).attr("href");
			$(val).attr("href",href+"/criteria:")
		});				
	});
	var $containerSearch=$(".container-search");
	$("butt	on#searchPlayer").live("click",function(e){
		var nombre=$("#nombre").val();
		var email=$("#email").val();
		$containerSearch.load($containerSearch.attr("rel"),{},function(){
			$.each($(this).find(".paging a"),function(i,val){
				var href=$(val).attr("href");
				$(val).attr("href",href+"/nombre:"+nombre+"/email:"+email)
			});				
		});
	});
});
</script>