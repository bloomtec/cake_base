<div class="score-box">
 <?php __("Tienes: "); ?><br /> <span>&nbsp;&nbsp;</span>	
 <p>
 	<?php __('acumulados'); ?>
 </p>		
</div>
<script type="text/javascript">
	$(function(){
		$('.score-box span').load('/users/getScore');
	});
</script>