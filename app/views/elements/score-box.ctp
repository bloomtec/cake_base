<div class="score-box">
<?php $score= $this -> requestAction('/users/getScore');?>
 <?php __("Tienes: "); ?><br /> <span><?php echo "$ ".number_format($score, 0, ",", "."); ?></span>	
 <p>
 	<?php __('acumulados'); ?>
 </p>		
</div>