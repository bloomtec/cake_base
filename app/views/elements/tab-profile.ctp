<div class="pane" id="profile">
	<div class="profile tab" rel="profile">
	</div>
	<div class="body">
		<div class="notifications">
		</div>
	</div>
</div>
<script>
$("#profile .body").load("/users/index");
$(".paging a").live("click",function(e){
	e.preventDefault();
	$("#profile .body").load($(this).attr("href"));
});
</script>