<style>
	.start{
		width:17px;
		height:17px;
		float:left;
	}
	.active{
		cursor:pointer;
	}
	.start-0{
		background: url(/img/estrella_inact.png);
		
	}
	.start-1{
		background: url(/img/estrella_mid.png);
		
	}
	.start-2{
		background: url(/img/estrella_mid.png);
		
	}
	.start-3{
		background: url(/img/estrella_mid.png);
		
	}

	.start-4{
		background: url(/img/estrella_act.png);
		
	}
	.poll.message{
		display:none;
	}
</style>
<?php if( $session -> read('Auth.User.id') && $active ){?>
<div class='vote active' rel='<?php echo $model."/".$foreign_key; ?>'>
	<div class='start' rel='0'> </div>
	<div class='start' rel='1'> </div>
	<div class='start' rel='2'> </div>
	<div class='start' rel='3'> </div>
	<div class='start' rel='4'> </div>
	<div style='clear:both;'></div>
	<span class='poll message'>actualizando..</span>
</div>



<?php }else{ ?>
<div class='vote' rel='<?php echo $model."/".$foreign_key; ?>'>
	<div class='start' rel='0'> </div>
	<div class='start' rel='1'> </div>
	<div class='start' rel='2'> </div>
	<div class='start' rel='3'> </div>
	<div class='start' rel='4'> </div>
	<div style='clear:both;'></div>
</div>
<?php } ?>