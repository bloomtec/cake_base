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
	
</style>
<?php if( $session -> read('Auth.User.id') && $active ){?>
<div class='vote active' rel='<?php echo $product['Product']['id']; ?>'>
	<div class='start' rel='0'> </div>
	<div class='start' rel='1'> </div>
	<div class='start' rel='2'> </div>
	<div class='start' rel='3'> </div>
	<div class='start' rel='4'> </div>
	<div style='clear:both;'></div>
</div>
<?php }else{ ?>
<div class='vote' rel='<?php echo $product['Product']['id']; ?>'>
	<div class='start' rel='0'> </div>
	<div class='start' rel='1'> </div>
	<div class='start' rel='2'> </div>
	<div class='start' rel='3'> </div>
	<div class='start' rel='4'> </div>
	<div style='clear:both;'></div>
</div>
<?php } ?>
<script type="text/javascript">
	$(function(){
		var estrellas= {}
		var initVote =function(average){
			var num=average.split('.');
			var i=0;
			for( ; i < num[0]; i += 1){
				estrellas[i]= {'element':$('div.start[rel="'+i+'"]'),'first-class':'start start-4','actual-class':'start start-4'};
				$('div.start[rel="'+i+'"]').attr('class','start start-4');
			}
			
			if(num.length == 2){
				estrellas[i]= {'element':$('div.start[rel="'+i+'"]'),'first-class':'start start-2','actual-class':'start start-2'};
				$('div.start[rel="'+i+'"]').attr('class','start start-2');
				i += 1;
			}
			for( ; i < 5; i += 1){
				estrellas[i]= {'element':$('div.start[rel="'+i+'"]'),'first-class':'start start-0','actual-class':'start start-0'};
				$('div.start[rel="'+i+'"]').attr('class','start start-0');
			}
		}
	
		BJS.post('/productsPolls/getProductPoll/'+$('.vote').attr('rel'),{},function(data){
			initVote(data);
		});
		$('.active .start').mouseenter(function(){
			var $that=$(this);
			var thatRel=$that.attr('rel');
			$.each(estrellas,function(i,val){
				if(thatRel >= val['element'].attr('rel')){
					val['element'].removeClass('start-0 start-1 start-2 start-3').addClass('start-4');
					val['actual-class'] = 'start-5';
				}else{
					val['element'].removeClass('start-0 start-1 start-2 start-3 start-4').addClass('start-0');
					val['actual-class'] = 'start-0';
				}
			});
			/* $(this).removeClass('start-0 start-1 start-2 start-3 start-4').addClass('start-5');
			$(this).prevAll().removeClass('start-0 start-1 start-2 start-3 start-4').addClass('start-5');
			estrellas[$(this).attr('rel')]['actual-class']='start-5'; */
		});
		$('.active .vote').mouseout(function(){
			$.each(estrellas,function(i,val){
				val['element'].removeClass('start-0 start-1 start-2 start-3 start-4').addClass(val['first-class']);
				val['actual-class'] = val['first-class'];
			});
		});
		$('.active .start').click(function(){
			BJS.post('/productsPolls/userPoll/'+$('.vote').attr('rel') + '/' + (parseInt($(this).attr('rel')) + 1),{},function(data){
			if(data){ 
				initVote(data)
			};
		});
		});
	})
</script>