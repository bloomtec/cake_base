<div class="pane" id="payfoll">
	<div class="payfoll tab" rel="payfoll">
	</div>
	<div class="body">
		<div class="content" style="width:90%;">
			<div class="container-search all" rel="/teams/ajaxSearch/criteria:">
					
			</div>			
		</div>
		<div style="clear:both;"></div>
	</div>
</div>
<script>
$(function(){
	var $container=$(".container-search");
	$container.load($container.attr("rel"),{},function(){
		$.each($(this).find(".paging a"),function(i,val){
			var href=$(val).attr("href");
			console.log(val);
			console.log(href);
			$(val).attr("href",href+"/criteria:"+criteria)
		});				
	});
});
</script>