<div class="brands tahoma">
		<?php foreach($brands as $brand):?>
		<div class="marcas">
			<img src="/img/uploads/<?php echo $brand['Brand']['image_brand']?>" />
			<h1><?php echo $brand['Brand']['name']?></h1>
			<h2><?php echo $brand['Brand']['country']?></h2>
			<div style="clear: both"></div>
		</div>
		<p><?php echo $brand['Brand']['description']?>
		</p>
		<div style="clear: both"></div>
		<?php endforeach;?>
</div>
<script type="text/javascript">
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